<h1 align="center">🌱Project: Website bán thực phẩm Organic</h1>

## 👤 Thông Tin Cá Nhân  
- **Họ tên**: Phan Thị Gia Hân
- **Mã sinh viên**: 23010840
- **Lớp**: CNTT_8
- **Môn học**: Xây dựng web nâng cao (TH3)

## 📈 Mục đích dự án
- Xây dựng website bán thực phẩm Organic giúp khách hàng dễ dàng xem, đặt hàng, thanh toán và theo dõi quá trình giao hàng.
- Hỗ trợ chủ shop quản lý sản phẩm, đơn hàng, khách hàng, danh mục và thông báo.
- Cung cấp thông tin hữu ích về thực phẩm sạch, giúp khách hàng lựa chọn sản phẩm an toàn cho sức khỏe.

## 🛠️ Công nghệ sử dụng

| Công nghệ | Mô tả |
|----------|-------|
| **Laravel (PHP)** | Backend framework chính |
| **Laravel Breeze** | Hệ thống xác thực, session |
| **Blade + Tailwind CSS** | Giao diện người dùng |
| **MySQL (Aiven)** | Cơ sở dữ liệu |
| **Eloquent ORM** | Truy vấn và xử lý dữ liệu |
| **Middleware** | Bảo mật CSRF, kiểm soát truy cập |

## ⚙️ Sơ đồ chức năng

Sơ đồ tổng quát

[![Sơ đồ khối](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/so-do-khoi.png)](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/so-do-khoi.png)


Quy trình đặt hàng

![image](https://github.com/user-attachments/assets/so-do-quy-trinh-dat-hang.png)

Quản lý sản phẩm

![image](https://github.com/user-attachments/assets/so-do-quan-ly-san-pham.png)

Quản lý đơn hàng & thông báo

![image](https://github.com/user-attachments/assets/so-do-thong-bao-don-hang.png)

## 📊 Sơ đồ tuần tự

Đăng ký tài khoản

![image](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/he-thong.png)](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/he-thong.png)



Đặt hàng & nhận thông báo

![image](https://github.com/user-attachments/assets/so-do-dat-hang-thong-bao.png)

## Sơ đồ khối 

![image](https://github.com/user-attachments/assets/so-do-khoi-organic.png)

---

<h1>Một số code minh họa</h1>

## Model

#### Order Model 
```php
class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'address', 'order_notes', 'total', 'status'
    ];
    public function user() { return $this->belongsTo(User::class); }
    public function orderDetails() { return $this->hasMany(OrderDetail::class); }
}
```

#### Product Model

```php
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'price', 'category_id', 'description', 'stock', 'image'
    ];
    public function category() { return $this->belongsTo(Category::class); }
    public function reviews() { return $this->hasMany(Review::class); }
}
```

#### Notification Model

```php
class Notification extends Model
{
    protected $fillable = ['user_id', 'title', 'body', 'is_read'];
    public function user() { return $this->belongsTo(User::class); }
}
```

## Controller

#### Order Controller

```php
public function store(Request $request)
{
    $order = Order::create([...]);
    // Gửi thông báo cho user
    Notification::create([
        'user_id' => $order->user_id,
        'title' => 'Đặt hàng thành công',
        'body' => 'Đơn hàng #' . $order->id . ' đã được ghi nhận!',
        'is_read' => false,
    ]);
    return redirect()->route('order.success');
}
```

#### AdminOrder Controller (Cập nhật trạng thái & gửi thông báo)

```php
public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $oldStatus = $order->status;
    $order->update($request->all());
    if ($oldStatus !== $request->status) {
        Notification::create([
            'user_id' => $order->user_id,
            'title' => 'Cập nhật đơn hàng #' . $order->id,
            'body' => 'Đơn hàng của bạn đã chuyển sang trạng thái: ' . $request->status,
            'is_read' => false,
        ]);
    }
    return redirect()->route('admin.order')->with('success', 'Order updated successfully.');
}
```

## View

- Sử dụng Blade, Bootstrap, Tailwind.
- Hiển thị thông báo quá trình giao hàng qua chuông (bell icon).
- Đánh giá sản phẩm theo sao sau khi nhận hàng.

---

<h1> 🔒 Security Setup</h1>

- Sử dụng CSRF Token cho mọi form.
- Validate dữ liệu đầu vào ở Controller/Request.
- Chỉ admin mới truy cập được các route quản trị (middleware).
- Sử dụng Eloquent ORM để chống SQL Injection.
- Escape dữ liệu khi hiển thị ra view để chống XSS.

---

<h1> 🔗 Link </h1>

## Github link

<https://github.com/[your-github]/OrganShop/>

## Demo website
<https://your-demo-link.com/>

---

<h1> 📷 Một số hình ảnh chức năng chính</h1>

Trang chủ

![image](https://github.com/user-attachments/assets/trang-chu-organic.png)

Trang sản phẩm

![image](https://github.com/user-attachments/assets/san-pham-organic.png)

Trang giỏ hàng

![image](https://github.com/user-attachments/assets/gio-hang-organic.png)

Trang quản lý đơn hàng (admin)

![image](https://github.com/user-attachments/assets/quan-ly-don-hang-admin.png)

Thông báo quá trình giao hàng

![image](https://github.com/user-attachments/assets/thong-bao-giao-hang.png)

---

<h1>License & Copy Rights</h1>

The Laravel framework is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT" rel="nofollow">MIT license.</a>
