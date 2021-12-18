# アプリケーション名
衣装交換アプリ　(SnowClothes)
## アプリケーション概要

ダンサーによるダンサーのための洋服交換アプリケーションです。


## URI
```
https://snowclothes.herokuapp.com/

```

## テスト用アカウント
google-login-account:  testuser1@gmail.com

password:  testuser1

## 利用方法
まず、自分の既に持っているgoogle accountでログインします。その後、自分が使えそうな衣装（洋服）記事をクリックして、衣装の詳細画面へ移動します。詳細画面では「いいね！」や「コメント機能」が使えるようになっており、この衣装を実際に貸してほしくなった場合には「レンタルリクエストボタン」をクリックすることで、その記事の投稿者に一覧として表示されるようになります。投稿者側は「レンタルリクエスト」一覧の中から一人貸し出す人物を選び、「貸し出し許可ボタン」を押すことでその人物宛のメールフォームが表示されるので件名、本文を入力し送信します。レンタルリクエスト申請者は送られてきたgmailに投稿者のmailが書かれているので、そこ宛に返信することで両者のマッチングが成立します。

## 目指した課題解決

学生ダンサーの大きな悩みの１つである。毎回の衣装代の出費を抑え、友達間でしか行われていない衣装（洋服）の貸し出しをサークル全体で行えば新しい交流が生まれ、金銭にとらわれず気兼ねなくダンスができること。

## 実装した機能
コロナ禍で加入しているサークルにてGoole Accountを作成したので、Google Accountログイン機能を付けました。また、サークル内で利用するために作成したので、「LINEログイン機能」も追加しました。ログインしなくとも投稿一覧は見ることができますが、ログインすることで投稿、「いいね！」、「コメント機能」、「レンタルリクエスト機能」が使用可能になります。レンタルリクエストが承認され両者をアプリ外でもマッチングさせるために「メール機能」も付けました。また、投稿の際、タグを選択することで利用者が自分が欲しい衣装（洋服）を見つけやすいようにしました。

## 実装予定の機能
bladeをすべhtmlで作成したことで、行数が多くわかりにくくなったため、Reactでシンプルかつ、効率的に書き直します。また、gmailで行っていたリクエスト承認後のメールもLINEチャットボットで行えるようにしたいと考えています。


## デモ
####  ログインページ
![スクリーンショット (94)](https://user-images.githubusercontent.com/87055309/146140760-52ad27f2-7c0b-4f4a-a255-8064f0bb49cc.png)
![スクリーンショット (95)](https://user-images.githubusercontent.com/87055309/146140792-852895b7-336a-4956-89f2-4f1d17ba8dcf.png)



#### ログイン後の投稿一覧ページ
![スクリーンショット (85)](https://user-images.githubusercontent.com/87055309/146140835-dc74a397-8ec3-4c8d-9fe0-76a4fe85363b.png)


#### 投稿ページ
![スクリーンショット (88)](https://user-images.githubusercontent.com/87055309/146140876-f9d3cc88-8d6d-4b4f-9c27-1dfe3508e2b3.png)


#### 編集画面ページ
![スクリーンショット (96)](https://user-images.githubusercontent.com/87055309/146141004-2b6919f9-cf75-46ec-b814-45857ad3cbca.png)


#### 投稿詳細ページ（投稿者）
![スクリーンショット (98)](https://user-images.githubusercontent.com/87055309/146141659-21c2bbbf-a62d-46b4-9d15-66547f209cee.png)
![スクリーンショット (99)](https://user-images.githubusercontent.com/87055309/146141706-10732320-1b8e-4249-92e2-57ce20e0a436.png)
![スクリーンショット (100)](https://user-images.githubusercontent.com/87055309/146141740-4fff458c-5ab8-4df8-b636-882c669cac79.png)

#### 投稿詳細ページ（投稿者/リクエスト承認後）
![スクリーンショット (101)](https://user-images.githubusercontent.com/87055309/146141833-b71494f8-2075-45d0-813d-75e79a50afa1.png)
![スクリーンショット (102)](https://user-images.githubusercontent.com/87055309/146141859-95713294-c5e4-4455-b07f-2fe5dc819f14.png)
![スクリーンショット (103)](https://user-images.githubusercontent.com/87055309/146141890-7f479b52-c241-4ab1-822c-59cd1794969c.png)

#### 投稿詳細ページ（閲覧者）
![スクリーンショット (104)](https://user-images.githubusercontent.com/87055309/146142242-f300ec5b-507b-4df7-8406-4e616baaa446.png)
![スクリーンショット (106)](https://user-images.githubusercontent.com/87055309/146142253-b5b94e25-9cfd-4b0d-b1a4-262b9f55d891.png)


#### タグ検索ページ
![スクリーンショット (108)](https://user-images.githubusercontent.com/87055309/146142635-e3ab97a4-5694-4a54-b922-cc6212a3a383.png)

#### 受信メール
![image0](https://user-images.githubusercontent.com/87055309/146142659-2b248f26-72ad-4a07-8ed6-35a2bc2806f5.png)



