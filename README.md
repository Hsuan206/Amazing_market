# 注意事項

### 1.要用連結的時候(外部引入圖片、js、css) 請用

` {{asset('連結')}} `

### 不然放在系統上會故障

### 2.有用到資料庫的 在Model跟Controller中的Table名稱記得大小寫要相同

#### 因為在Windows中不分大小寫 但是Linux會區分 所以到時候放上去會出事


# 如何開始

`git clone https://gitlab.com/smilehappy126/miswhatever.git`

`cd miswhatever`

`composer install`

`cp .env.example .env`

`php artisan key:generate`

開編輯器 更改.env 建資料庫

`php artisan migrate`

`git branch "YourBranch"`    

`git checkout "YourBranch"`

`php artisan serve`   

開始寫程式吧~~~  

# 如何上傳

`git add .`

`git commit -m "你這次改了什麼"`

`git push` / 新的branch要用 `git push -u origin "YourBranch"`

# 程式碼準則
HTML:  
屬性永遠使用雙引號，永遠別用單引號。  
屬性應按照特定順序撰寫，確保程式碼的易讀性。
- class
- id, name
- data-*
- src, for, type, href
- title, alt
- aria-其他, role
- Class 是為了重用的元素而生，應該排第一位。ID 具體得多，應盡量少用（可用場景像是頁內書籤），所以排第二位。  

PHP:  
程式碼縮排請按一次Tab  
Model字首大寫、單數  
`User.php`  
資料表字首小寫、複數  
`users`  
Controller字首大寫  
`UserController.php`  
View的檔案名稱及資料夾名稱應全小寫  
`user.blade.php`  
Function的名稱動詞小寫＋名詞大寫  
`getUser()`
