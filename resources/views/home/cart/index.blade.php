@extends('home.layouts.master')
@section('content')
    <div id="content" >
        <div class="car main">
            <div class="carshop">
                <div class="cartitle">
                    <div class="carcheck">
                        <div class="checkbox">
                            <span class="check" :class="{check:false,checkon:allCheckStatus}" @click="allChecked"  id="allcheck"></span>
                        </div>
                        全选
                    </div>
                    <div class="carname">商品名称</div>
                    <div class="carmoney">单价</div>
                    <div class="carnum">数量</div>
                    <div class="carcount">小计</div>
                    <div class="carhandle">操作</div>
                </div>
                    <div v-for="(v,k) in carts" class="shopcontent" style="height: auto;overflow: hidden">
                        <div class="shopcheck">
                            <div class="checkbox">
                                <span @click="select(v)" :class="{check:true,checkon:v.checked}"></span>
                                <input type="checkbox"  name='checkbox' class="checkhide"/>
                            </div>
                        </div>
                        <div class="shopname">
                            <div class="carimg">
                                <a href=""><img :src="v.pic"/></a>
                            </div>
                            <p>
                                <a :href="'/home/content/'+v.good_id">@{{ v.title}}</a>
                                <br>
                                <span>@{{v.spec }}</span>
                            </p>
                        </div>
                        <div class="shopmoney">@{{ v.price }}元</div>
                        <div class="shopnum">

                            <a href="javascript:;"  class="num_l" @click="reduce(v)">-</a>
                            {{--change监听保证其他v的改变--}}
                            <input type="text" v-model="v.num"  @change="gengxin(v)"/>
                            <a href="javascript:;"  class="num_r" @click="add(v)">+</a>
                        </div>
                        <div class="shopcount">@{{v.num*v.price}}元</div>
                        <div class="shophandle" @click="del(v,k)">删除</div>
                       {{--删除<span>x</span>--}}
                    </div>

            </div>
            <div class="jiesuan">
                <div class="jixu"><a href="">继续购物</a></div>
                <div class="gongji">共计<span>@{{ carts.length }}</span>件商品</div>
                <div class="heji">合计<span>¥ @{{ totalPrice }}</span></div>
                <div class="gou">
                    <a href="javascript:;" @click="goSettlement">
                        <input type="submit" value="去结算"/>
                    </a>
                </div>

            </div>
        </div>
        {{--@{{ hasChecked }}--}}
    </div>
@endsection
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset ('org/home')}}/css/index.css"/>
@endpush
@push('js')
    <script src="{{asset ('org/home')}}/js/list.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdn.bootcss.com/vue/2.5.21/vue.min.js"></script>
    <script src="https://cdn.bootcss.com/axios/0.19.0-beta.1/axios.min.js"></script>
    <script>
        new Vue({
            el:'#content',
            data:{
                carts:{!! $carts!!},
                //传来的carts外层是个数组，内部元素是对象，所以可以用length
                allCheckStatus:false,
                hasChecked:[],//记录谁现在是选中状态
            },
            methods:{
                // 去下单结算
                    goSettlement(){
                        //判断用户是否有勾选商品
                        if (this.totalPrice==0){
                            layer.msg('请选择要结算的商品');
                            return;
                        }
                        //跳转到订单页面
                        location.href ="{{route('home.order.index')}}?ids="+this.hasChecked;
                    },
                // 全选单机事件
                allChecked(){
                    //首先让自己状态 true/false 进行切换
                    this.allCheckStatus =! this.allCheckStatus
                    //根据全选状态变化让单选跟着变化
                    this.hasChecked=[];
                    this.carts.forEach((v,k)=>{
                        if(this.allCheckStatus){
                            v.checked = true;
                            this.hasChecked.push(v.id);
                        }else{
                            v.checked = false;
                            this.hasChecked=[]
                        }
                    });
                },
                //单项选择
                select(v){
                    //将自己状态 true/false 转换
                    v.checked = !v.checked;
                    //如果现在自己状态是 true,说明自己选中
                    if(v.checked){
                        //将当前购物车 id 放到了一个新的数组中
                        this.hasChecked.push(v.id);
                    }else{
                        //检测制定元素在数组中位置indexOf,如果元素在数组检测元素,返回该元素位置,如果找不见制定元素,返回-1
                        var pos = this.hasChecked.indexOf(v.id);
                        //console.log(pos);
                        //如果取消选中,将当前取消购物车 id 冲数组踢出去
                        this.hasChecked.splice(pos,1);
                    }
                    //
                    if(this.hasChecked.length == this.carts.length){
                        this.allCheckStatus = true;
                    }else{
                        this.allCheckStatus = false;
                    }
                },
                add(v){

                    // console.log(this.carts);
                    if (v.num>=v.total) return;
                    v.num++;
                    this.update(v);//调用事件
                },
                reduce(v){
                    if(v.num <= 1) return;
                    v.num--;
                    this.update(v);
                },
                gengxin(v){
                    this.update(v);
                },
                //减
                update(v){
                    // console.log(v.num);
                    axios.put("/home/cart/"+v.id,{
                        num: v.num,
                    }).then(function (response) {
                        console.log(response);
                    });
                },
                del(v,k){
                    // alert(v,k);传入destory方法，得到cart表整条数据
                    axios.delete("/home/cart/"+v.id).then( (response)=>{
                        console.log(response);
                        this.carts.splice(k,1);
                    })
                }
            },
            //计算属性
            computed:{
                totalPrice(){
                    let total = 0;
                    this.carts.forEach((v,k)=>{
                        if(v.checked) {
                            total += v.price * v.num;
                        }
                    })
                    return total;
                }
            }
        });
        //删除

    </script>
@endpush
