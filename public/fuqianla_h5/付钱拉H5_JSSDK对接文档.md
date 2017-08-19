## 付钱拉H5_JSSDK对接文档
### 接入步骤
#### 第一步、通过script标签引入h5jssdk文件

```javascript
//请在地址后面加上随机时间戳，以便有更新时能穿透缓存机制获得最新版本sdk
<script src="//lib.fuqian.la/h5jssdk.4.0.js"></script>
```

#### 第二步、初始化配置参数`opt`
##### 此配置支持两种模式，一种是多通道列表，一种是单通道
1.多通道列表配置，此配置下会弹层显示所配置的支付通道

```javascript
//支付宝，微信公众号，银联为例
FUQIANLA.init({
    'app_id': '3hmd5BArSIk87ELxUBXWFA', //应用ID号
    'order_no': Date.now(), //订单号，此处为模拟订单号。具体以接入为准
    'channel': 'ali_pay_wap,wx_pay_pub,yl_pay_wap', //开通的通道简称
    'amount': '1', //支付金额
    'subject': 'h5测试数据', //商品标题
    'notify_url': 'http://fuqian.la', //异步支付结果通知地址
    'extra':{
        'wx_pay_pub': {
            'openid': 'wx123sdfaf'
        },
        'yl_pay_wap': {
            'return_url': 'http://fuqian.la'
        }
    }
});
```

2.1 单通道配置，此配置下会直接跳所配置的支付通道

```javascript
//支付宝和京东为例
FUQIANLA.init({
    'app_id': '3hmd5BArSIk87ELxUBXWFA', //应用ID号
    'order_no': Date.now(), //订单号，此处为模拟订单号。具体以接入为准
    'channel': 'ali_pay_wap', //开通的通道简称
    'amount': '1', //支付金额
    'subject': 'h5测试数据', //商品标题
    'notify_url': 'http://fuqian.la' //异步支付结果通知地址
});

FUQIANLA.init({
    'app_id': '3hmd5BArSIk87ELxUBXWFA', //应用ID号
    'order_no': Date.now(), //订单号，此处为模拟订单号。具体以接入为准
    'channel': 'jd_pay_wap', //开通的通道简称
    'amount': '1', //支付金额
    'subject': 'h5测试数据', //商品标题
    'notify_url': 'http://fuqian.la', //异步支付结果通知地址
    'extra': {
        'return_url': 'http://fuqian.la'
    }
});
```

2.2 自定义签名单通道配置，此配置下会直接跳所配置的支付通道

```javascript
/*
 * 自定义签名会增加两个字段，且是必填项
 * sign_info String 签名信息
 * sign_type String 签名格式RSA／MD5
 */
//支付宝和京东为例
FUQIANLA.init({
    'app_id': '3hmd5BArSIk87ELxUBXWFA', //应用ID号
    'order_no': Date.now(), //订单号，此处为模拟订单号。具体以接入为准
    'channel': 'ali_pay_wap', //开通的通道简称
    'amount': '1', //支付金额
    'subject': 'h5测试数据', //商品标题
    'notify_url': 'http://fuqian.la', //异步支付结果通知地址
    'sign_info': 'f9124a0d7c07d72d2423b5b8357a7f0a',
    'sign_type': 'MD5'
});

FUQIANLA.init({
    'app_id': '3hmd5BArSIk87ELxUBXWFA', //应用ID号
    'order_no': Date.now(), //订单号，此处为模拟订单号。具体以接入为准
    'channel': 'jd_pay_wap', //开通的通道简称
    'amount': '1', //支付金额
    'subject': 'h5测试数据', //商品标题
    'notify_url': 'http://fuqian.la', //异步支付结果通知地址
    'extra': {
        'return_url': 'http://fuqian.la'
    },
    'sign_info': '0dcc3212bbbd2a7cb1710190cf508959f0a912d6c65874eb96f89d8c57a4a8b7653522871f9e7ffbdbe22f6eb5bcd7118afb9b7315a379771dc297bed6744baf0889ceff285d94d75386e80d78bc8efbb19c4aa11f9eceab13159c75f5b237325bdaff4989de27b1800cff596c85d867d40b60c51b25c3433f9cc4cf64933dbb',
    'sign_type': 'RSA'
});
```

### `opt`配置参数说明

参数                     |参数名称                 |类型(长度)                |参数说明                 |是否必填
------------------------|------------------------|------------------------|------------------------|------------------------
app_id|应用ID|String(35)|签约商户的应用ID号|Y
order_no|订单号|String(32)|合作商户唯一的订单号|Y
channel|通道|String|商户已开通支付通道简称，多通道用英文逗号(,)隔开|Y
amount|金额|String|该笔订单的金额总额，单位：分|Y
subject|商品名称|String|商品标题/交易标题/订单标题/订单关键字等|Y
notify_url|服务器异步通知地址|String(254)|付钱拉服务器主动通知商户服务器指定路径|Y
body|交易详情|String|对该笔交易的具体描述信息|N
optional|自定参数|String|要自定义参数时，请填写|N
extra|扩展参数|Object|对通道必填参数扩展，多通道列表模式下得包含某些通道的简称，单通道模式下不需要|N
sign_type|签名类型|String|支付信息使用签名的类型（MD5／RSA），注：自定义签名时只支持单通道|N
sign_info|签名信息|String|对支付信息使用MD5/RSA签名，注：自定义签名时只支持单通道|N

### `extra`中各支付通道请求参数如下:

> * 支付宝WAP支付(`ali_pay_wap`)
>
> 参数                     |参数名称                 |类型(长度)                |参数说明                 |是否必填
> ------------------------|------------------------|------------------------|------------------------|------------------------
> return_url|返回地址|String(254)|支付成功后返回商户地址（查询字符？后面都会过滤，请不要传）|N
>
> * 微信公众号(`wx_pay_pub`）
>
> 参数                     |参数名称                 |类型(长度)                |参数说明                 |是否必填
> ------------------------|------------------------|------------------------|------------------------|------------------------
> openid|微信用户标识|String(254)|普通用户的标识，对当前公众号唯一|Y
> cb|支付成功回调函数|Function @param data|微信支付成功后返回data，并执行该回调|N
> ecb|支付失败回调函数|Function @param data|微信支付失败后返回data，并执行该回调（在关闭支付时也会执行）|N
>
> * 银联WAP支付(`yl_pay_wap`）
>
> 参数                     |参数名称                 |类型(长度)                |参数说明                 |是否必填
> ------------------------|------------------------|------------------------|------------------------|------------------------
> return_url|返回地址|String(254)|支付成功后返回商户地址（查询字符？后面都会过滤，请不要传）|Y
>
> * 百度WAP支付(`bd_pay_wap`）
>
> 参数                     |参数名称                 |类型(长度)                |参数说明                 |是否必填
> ------------------------|------------------------|------------------------|------------------------|------------------------
> return_url|返回地址|String(254)|支付成功后返回商户地址（查询字符？后面都会过滤，请不要传）|N
>
> * 京东WAP支付(`jd_pay_wap`）
>
> 参数                     |参数名称                 |类型(长度)                |参数说明                 |是否必填
> ------------------------|------------------------|------------------------|------------------------|------------------------
> return_url|返回地址|String(254)|支付成功后返回商户地址（查询字符？后面都会过滤，请不要传）|Y
> token|token|String|识别用户信息,支付成功后会调用successCallbackUrl返回给商户|N
>
> * 易宝WAP支付(`yb_pay_wap`）
>
> 参数                     |参数名称                 |类型(长度)                |参数说明                 |是否必填
> ------------------------|------------------------|------------------------|------------------------|------------------------
> productcatalog|类别码|String(254)|商品类别码, 投资通为：30|Y
> identityid|用户标识|String|用户标识,商户生成的用户账号唯一标识|Y
>


### 不使用收银台模式时支持单通道支付签名
#### 支持MD5和RSA签名，参与签名参数如下

参数                     |参数名称                 |参数类型                 |是否必填
------------------------|------------------------|------------------------|------------------------
app_id|应用id|String|Y
charge|支付对象|Object|Y
charge[order_no]|订单号|String|Y
charge[amount]|支付金额（单位：分）|String|Y
charge[channel]|支付通道|String|Y
charge[subject]|商品名称|String|Y
charge[notify_url]|服务器异步通知地址|String|Y
charge[extra]|扩展参数(为空时不填)|Object|N

### 附录

备注：自定义签名只支持单通道，请在服务端生成生成签名信息后再发送给前端

1.1 签名数据结构

> 1.1.1 没有extra扩展字段

> ```json
>{
>   app_id: '3hmd5BArSIk87ELxUBXWFA',
>   charge: {
>       order_no: '1478154241989',
>       amount: 1,
>       channel: 'wx_pay_pub_scan',
>       subject: '微信扫码自定义签名测试',
>       notify_url: 'http://fuqian.la'
>   } 
>}
> ```
> 
> 1.1.2 有extra扩展字段
> 
> ```json
>{
>   app_id: '3hmd5BArSIk87ELxUBXWFA',
>   charge: {
>       order_no: '1478154241989',
>       amount: 1,
>       channel: 'jd_pay_pc',
>       subject: '京东PC支付自定义签名测试',
>       notify_url: 'http://fuqian.la',
>       extra: {
>           return_url: 'http://fuqian.la'
>       }
>   } 
>}
> ```

1.2 签名方式

签名方式请参考 <a href="http://fuqian.la/docs.html?api" target="_top">API 接入指南 - 5. 附录</a>

1.3 支付结果异步通知

支付结果异步通知请参考 <a href="http://fuqianla.net/docs.html?renotify" target="_top">支付结果异步通知</a>

