<h1 align="center">🥕🌿Project: Website bán thực phẩm Organic🌿🥕</h1>

## 📚 Mục lục

- [👤 Thông Tin Cá Nhân](#-thông-tin-cá-nhân)
- [📈 Mục Đích Dự Án](#-mục-đích-dự-án)
- [🛠️ Công Nghệ Sử Dụng](#️-công-nghệ-sử-dụng)
- [⚙️ Kiến Trúc Hệ Thống & Sơ Đồ](#️-kiến-trúc-hệ-thống--sơ-đồ)
- [📊 Sơ Đồ Tuần Tự](#-sơ-đồ-tuần-tự)
- [💻 Một Số Code Minh Họa](#một-số-code-minh-họa)
- [🔐 Bảo Mật](#-bảo-mật)
- [📸 Một Số Hình Ảnh Giao Diện](#-một-số-hình-ảnh-giao-diện)
- [📝 License](#-license)
- [🔗Liên Kết](#-liên-kết)



---

## 👤 Thông Tin Cá Nhân

- **Họ tên**: Phan Thị Gia Hân  
- **MSSV**: 23010840  
- **Lớp**: CNTT_8  
- **Môn học**: Xây dựng Web Nâng Cao (TH3)

---

## 📈 Mục Đích Dự Án

- Cung cấp nền tảng website giúp người dùng mua thực phẩm Organic trực tuyến.
- Hỗ trợ quản lý sản phẩm, đơn hàng, khách hàng, danh mục và thông báo hiệu quả.
- Tăng nhận thức về thực phẩm sạch, an toàn cho sức khỏe.

---

## 🛠️ Công Nghệ Sử Dụng

| Công nghệ        | Vai trò chính                        |
|------------------|--------------------------------------|
| **Laravel**      | Framework PHP backend chính          |
| **Laravel Breeze** | Xác thực người dùng, session       |
| **Blade + Tailwind CSS** | Giao diện frontend nhẹ, đẹp  |
| **MySQL (Aiven)** | Cơ sở dữ liệu chính                 |
| **Eloquent ORM**  | Xử lý dữ liệu dạng hướng đối tượng |
| **Middleware**    | Bảo mật & kiểm soát truy cập        |

---

## ⚙️ Kiến Trúc Hệ Thống & Sơ Đồ

### 🔹 Sơ đồ khối
![Sơ đồ khối](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/so-do-khoi.png)

### 🔹 Sơ đồ chức năng

![](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/chucnang.drawio.png)


---

## 📊 Sơ Đồ Tuần Tự

- **Sử dụng hệ thống**  
  ![](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/he-thong.png)
  
  - **Quản lý tài khoản**
  ![](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/qltk.png)

- **Quản lý sản phẩm**  
  ![](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/qlsp.png)

- **Quản lý đơn đặt hàng**
  ![](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/qld.png)
  
  
- **Quản lý danh mục**
  ![](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/cuoi.png)

---

<h1>💻Một Số Code Minh Họa</h1>

<h2>📦Model</h2>

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
 

<h2>🧠CController</h2>

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
```

```php
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
## 🔐 Bảo Mật



- Sử dụng CSRF Token cho mọi form.
- Validate dữ liệu đầu vào ở Controller/Request.
- Chỉ admin mới truy cập được các route quản trị (middleware).
- Sử dụng Eloquent ORM để chống SQL Injection.
- Escape dữ liệu khi hiển thị ra view để chống XSS.

Ví dụ:CSRF & XSS Token bảo vệ form (ví dụ: productdetail.blade)
```php
 <!-- Form thêm vào giỏ -->
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <div class="product__details__quantity">
                    <div class="quantity">
                        <div class="pro-qty">
                            <input name="quantity" value="1" min="1" type="number">
                        </div>
                    </div>
                </div>

                <button type="submit" class="primary-btn">ADD TO CARD</button>
            </form>

```
## 📷 Một Số Hình Ảnh Giao Diện

### 👤 Người Dùng (User)

- **Đăng ký**  
  ![Đăng ký](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/dang-ky.png)

- **Đăng nhập**  
  ![Đăng nhập](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/dang-nhap.png)

- **Trang chủ**  
  ![Home](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/home.png)  
  ![Home 2](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/home2.png)

- **Trang giới thiệu**  
  ![Giới thiệu](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/gioithieu.png)

- **Trang sản phẩm**  
  ![Shop](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/shop.png)

- **Giỏ hàng**  
  ![Giỏ hàng](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/giohang.png)

- **Thanh toán (Checkout)**  
  ![Checkout](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/checkout.png)

- **Liên hệ**  
  ![Contact](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/contact.png)

- **Trang phản hồi**  
  ![Phản hồi](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/phan_hoi.png)

---

### 🔧 Quản Trị Viên (Admin)

- **Dashboard**  
  ![Dashboard](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/home_admin.png)

- **Quản lý người dùng**  
  ![Quản lý user](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/qlu.png)

- **Quản lý đơn hàng**  
  ![Quản lý đơn hàng](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/qlo.png)

- **Quản lý sản phẩm**  
  ![Quản lý sản phẩm](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/qlp.png)

- **Quản lý danh mục**  
  ![Quản lý danh mục](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/qlc.png)

- **Thông báo**  
  ![Thông báo](https://raw.githubusercontent.com/PhanThiGiaHan108/Organ/master/public/assets/images/thongbao.png)

---
## 🔗 Liên Kết
<<<<<<< HEAD
 -🔗 GitHub:https://github.com/PhanThiGiaHan108/Organ

 -🥦Readme (web io) :https://phanthigiahan108.github.io/Organ/

-🌐 Public Website: https://organshop-master-uvy5n7.laravel.cloud/

 
## 📝 License

This project is built using [Laravel](https://laravel.com), which is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
