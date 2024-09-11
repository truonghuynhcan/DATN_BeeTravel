# BeeTravel
> Website thương mại điện tử về du lịch

## Tải và cài đặt lần đầu
1. Vào folder www -> mở terminal 
```terminal
git clone https://github.com/truonghuynhcan/DATN_BeeTravel.git
```
3. Vào file vừa cài -> mở terminal
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```
5. Trong file **.env** -> chỉnh kết nối đến với db
6. Sau khi kết nối với db xong thì sử dụng lệnh để tạo db
```bash
php artisan migrate
```
## Làm việc với file
1. Tạo nhánh và chuyển vào nhánh
```bash
git checkout -b tennhanh
```
> `Quy tắt đặt tên nhánh`
> feature/ten-chuc-nang
> vd: git checkout -b feature/dang-nhap
2. Kiểm tra lại nhánh vừa tạo
```bash
git branch
```
3. Trong trường hợp muốn chuyển sang nhánh khác
```bash
git checkout tennhanh
```

## Cách đẩy (push) lên github
```bash
git add .
git commit -m "ghi gì đó"
git push origin tennhanh
```
> `Quy tắt commit`
> **[type]: [description]**
> vd: git commit -m "feat: add feature login"
> 

Một số type phổ biến được khuyên sử dụng bao gồm:
- `feat`: thêm một feature
- `fix`: fix bug cho hệ thống, vá lỗi trong codebase
- `refactor`: sửa code nhưng không fix bug cũng không thêm feature hoặc đôi khi bug cũng được fix từ việc refactor.
- `docs`: thêm/thay đổi document
- `chore`: những sửa đổi nhỏ nhặt không liên quan tới code
- `style`: những thay đổi không làm thay đổi ý nghĩa của code như thay đổi css/ui chẳng hạn.
- `perf`: code cải tiến về mặt hiệu năng xử lý
- `vendor`: cập nhật version cho các dependencies, packages.
## Sử dụng github
1.git clone https://github.com/truonghuynhcan/DATN_BeeTravel.git
khởi tạo git về máy
git branch 
    kiểm tra nhánh

git checkout -b tenNhanh
    tạo nhánh trên máy (thay ten = tên của mình)


SAU KHI CHỈNH SỬA CODE TRONG NHÁNH CỦA mình

git add .
    -> dùng lưu những gì đã chỉnh SỬA

git commit -m "ghi gì đó trong này"
    -> commit này dùng để ghi lại note cho những gì mình làm
    -> vd: "tạo trang X", "Tạo chức năng Y" - ghi càng chi tiết càng tốt

git push -u origin tenNhanh
    -> dùng push từ máy lên github

