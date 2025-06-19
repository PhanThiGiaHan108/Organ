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
![image](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/dh&tb.png)



## 📊 Sơ đồ tuần tự

Đăng ký tài khoản

![Sơ đồ hệ thống](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/he-thong.png)




Đặt hàng & nhận thông báo
             +---------------------+
             |  Đặt hàng & Nhận thông báo |
             +-----------+---------+
                         |
         +---------------+--------------+
         |               |              |
         v               v              v
+----------------+  +----------------+  +-------------------+
| Chọn sản phẩm  |  | Thanh toán     |  | Nhận thông báo    |
+----------------+  +----------------+  +-------------------+
         |                                  |
         v                                  v
+--------------------+           +--------------------------+
| Xác nhận đơn hàng  |           | Thông báo trạng thái đơn |
+--------------------+           +--------------------------+



![image](https://github.com/user-attachments/assets/so-do-dat-hang-thong-bao.png)

## Sơ đồ khối 

![image](https://github.com/user-attachments/assets/so-do-khoi-organic.png)

---

<h1>Một số code minh họa</h1>

## Model

#### User Model 
```php
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
 
```

#### Order Model

```php
class Order extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'address',
        'order_notes', 'subtotal', 'total', 'payment_method', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    
       
}
```


### OrderDetail Model
```php
class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'total'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
```

#### Product Model

```php
class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'discount_price', 'stock', 'image', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
```
#### Category Model
```php
class Category extends Model
{
    protected $fillable = ['name', 'slug','image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
```
### Contact Model

```php
class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'is_read',
        'user_id', 
    ];

    /**
     * Lấy các phản hồi của admin.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(ContactReply::class);
    }

    /**
     * Lấy thông tin user gửi tin nhắn.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
```
### ContactReply Model
 ```php
 class ContactReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'replied_by_user_id',
        'reply',
    ];
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'replied_by_user_id');
    }
}
 ```

 ### Cart Model
 ```php
 class Cart extends Model
{
    protected $fillable = ['user_id', 'subtotal', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
 ```

### CartItem Model
```php 
class CartItem extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price', 'total'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

```

### Notification Model
```php
class NotificationController extends Controller
{
    // Trang admin: hiển thị tất cả liên hệ + phản hồi
    public function index()
    {
        // Đánh dấu toàn bộ liên hệ là đã đọc (chỉ nên dùng cho admin)
        Contact::where('is_read', false)->update(['is_read' => true]);

        // Lấy liên hệ mới nhất và phản hồi tương ứng
        $contacts = Contact::with('replies')->latest()->get();

        return view('admin.notification', compact('contacts'));
    }

    // Admin gửi phản hồi
    public function storeReply(Request $request)
    {
        $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'reply' => 'required|string',
        ]);

        ContactReply::create([
            'contact_id' => $request->contact_id,
            'replied_by_user_id' => Auth::id(),
            'reply' => $request->reply,
        ]);

        return redirect()->back()->with('success', 'Đã gửi phản hồi!');
    }

    // Lấy số thông báo chưa đọc của user
    public function unreadCount()
    {
        $userEmail = Auth::user()->email;

        $unreadCount = Contact::where('email', $userEmail)
                              ->whereHas('replies') 
                              ->where('is_read', false)
                              ->count();

        return response()->json(['count' => $unreadCount]);
    }

    // Trang user xem các tin nhắn & đánh dấu đã đọc
    public function message()
    {
        $userEmail = Auth::user()->email;

        // Đánh dấu các phản hồi dành cho user hiện tại là đã đọc
        Contact::where('email', $userEmail)
            ->whereHas('replies') // chỉ đánh dấu những cái đã được trả lời
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Lấy tất cả liên hệ đã gửi kèm phản hồi
        $contacts = Contact::with('replies')
            ->where('email', $userEmail)
            ->latest()
            ->get();

        return view('user.contact-messages', compact('contacts'));
    }

    //  Tổng số tất cả các liên hệ có phản hồi
    public function totalCount()
    {
        $userEmail = Auth::user()->email;

        $total = Contact::where('email', $userEmail)
                        ->whereHas('replies')
                        ->count();

        return response()->json(['total' => $total]);
    }
    public function counts()
{
    $userEmail = Auth::user()->email;

    $total = Contact::where('email', $userEmail)
                    ->whereHas('replies')
                    ->count();

    $unread = Contact::where('email', $userEmail)
                     ->whereHas('replies')
                     ->where('is_read', false)
                     ->count();

    return response()->json([
        'total' => $total,
        'unread' => $unread
    ]);
}

}

```
 



## Controller

#### Contact Controller

```php
public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        // Lưu thông tin liên hệ vào database
        Contact::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'],
            'message' => $validated['message'],
            'is_read' => false, // tin nhắn mới gửi sẽ chưa đọc
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ!');
    }
```

#### AdminOrder Controller

```php
 public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $orders = Order::when($keyword, function ($query, $keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->with('orderDetails.product') 
            ->latest()
            ->paginate(10);

        return view('admin.order', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|max:50',
            'email'         => 'required|email|max:150',
            'phone'         => 'required|string|max:20',
            'address'       => 'required|string|max:200',
            'order_notes'   => 'nullable|string|max:1000',
            'total'         => 'required|numeric|min:0',
            'status'        => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'order_notes'   => $request->order_notes,
            'total'         => $request->total,
            'status'        => $request->status,
        ]);

        return redirect()->route('admin.order')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.order')->with('success', 'Order deleted successfully.');
    }
```

### AdminUserController

```php
 // Hiển thị danh sách người dùng với tìm kiếm
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $users = User::query()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('email', 'like', '%' . $keyword . '%');
            })
            ->orderBy('id','asc')
            ->get();

        return view('admin.user', compact('users'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:users,email,' . $id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role'    => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'role'    => $request->role,
        ]);

        return redirect()->route('admin.user')->with('success', 'Cập nhật người dùng thành công!');
    }

    // Xóa người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user')->with('success', 'Xóa người dùng thành công!');
    }
```


### 📄 Blade Template (View)
![View](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/view.png)



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

[https://github.com/[PhanThiGiaHan108]/Organ](https://github.com/PhanThiGiaHan108/Organ)


---

<h1> 📷 Một số hình ảnh chức năng chính</h1>

-----User----


Đăng ký  

![Đăng ký](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/dang-ky.png)





Đăng nhập

![Đăng nhập](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/dang-nhap.png)

Trang chủ

![Home](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/home.png)
![Home 2](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/home2.png)

 
Trang giới thiệu

![Giới thiệu](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/gioithieu.png)


Trang sản phẩm

![Shop](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/shop.png)


Trang giỏ hàng

![Giỏ hàng](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/giohang.png)

Trang checkout

![Checkout](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/checkout.png)

Trang Contact

![Liên hệ](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/contact.png)

 Trang phản hồi
 
![Phản hồi](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/phan_hoi.png)

----Admin---


Dashboard
![image](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/home_admin.png)

Quản lý user

![image](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/qlu.png)

Quản đơn hàng
![image](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/qlo.png)

Quản lý sản phẩm
![image](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/qlp.png)

Quản lý danh mục
![image](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/qlc.png)

Thông báo
![image](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/thongbao.png)


---

<h1>License & Copy Rights</h1>

The Laravel framework is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT" rel="nofollow">MIT license.</a>
