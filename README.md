# old_island
# 旧岛项目api

## 我本地开发配置域名：http://old_island.com/
## 线上域名：http://old_island.weixinhkj.xyz/

## 期刊、书籍、点赞 路由都与七月老师的路由一样
## 除了上面三个外，还添加了：
  1. login/login	获取令牌
  2. login/check	检测令牌是否过期 true过期
  3. save/user_info 保存微信基本信息
### 除了上面自定义三个方法外，所有方法均需要携带token访问

## 书籍接口我用的是豆瓣api,
  1. user_praise表中当type=400 art_id存放豆瓣api图书id
