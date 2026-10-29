

# **جزوه آموزشی: فرم‌ها در HTML و نحوه پردازش آن‌ها در PHP**

## **1. فرم چیست و چرا از آن استفاده می‌کنیم؟**

در صفحات وب، برای گرفتن اطلاعات از کاربر (مثل نام، ایمیل، رمز عبور، انتخاب گزینه‌ها و …) از **فرم (form)** استفاده می‌کنیم.

کاربر اطلاعات را وارد می‌کند → فرم ارسال می‌شود → اطلاعات به **PHP** می‌رسد → PHP آن‌ها را پردازش می‌کند.

---

# **2. تگ اصلی فرم در HTML**

فرم‌ها در HTML با تگ `<form>` ساخته می‌شوند.

### **ساختار کلی:**

```html
<form action="process.php" method="post">
    <!-- عناصر فرم -->
</form>
```

### **صفت‌های مهم تگ `<form>`**

## **الف) action**

مشخص می‌کند که اطلاعات فرم به **کدام صفحه PHP** ارسال شود.

مثال:

```html
<form action="save.php">
```

یعنی بعد از کلیک روی دکمه ارسال، اطلاعات به فایل **save.php** فرستاده می‌شود.

---

## **ب) method**

مشخص می‌کند اطلاعات به چه روشی ارسال شود:

### **1) POST**

* برای ارسال اطلاعات مهم، رمز، فرم ثبت‌نام و …
* اطلاعات در نوار آدرس دیده نمی‌شود
* امنیت بیشتر

### **2) GET**

* اطلاعات در آدرس صفحه ظاهر می‌شود
* مناسب جستجو، فیلتر، کارهای غیرمحرمانه
* محدودیت اندازه اطلاعات دارد

مثال:

```html
<form method="post">
```

---

## **ج) enctype (اختیاری)**

برای زمانی که فرم فایل (مثل عکس) ارسال می‌کند.

مثال:

```html
<form method="post" enctype="multipart/form-data">
```

---

# **3. انواع ورودی‌ها (input types)**

تگ اصلی دریافت اطلاعات:

```html
<input type="text">
```

در ادامه تمام انواع ورودی‌های مهم را توضیح می‌دهیم:

---

## **1) text**

برای وارد کردن متن معمولی مثل نام، نام خانوادگی.

```html
<input type="text" name="fullname" placeholder="نام کامل">
```

---

## **2) password**

برای رمز عبور (حروف دیده نمی‌شود)

```html
<input type="password" name="password">
```

---

## **3) email**

برای ایمیل، مرورگر بررسی می‌کند که درست باشد.

```html
<input type="email" name="email">
```

---

## **4) number**

اجازه ورود فقط عدد

```html
<input type="number" name="age" min="1" max="100">
```

---

## **5) radio**

برای انتخاب یک گزینه از چند مورد

```html
<input type="radio" name="gender" value="male"> مرد
<input type="radio" name="gender" value="female"> زن
```

**نکته:** name باید یکی باشد تا فقط یک گزینه انتخاب شود.

---

## **6) checkbox**

برای انتخاب چند گزینه

```html
<input type="checkbox" name="hobby[]" value="sport"> ورزش
<input type="checkbox" name="hobby[]" value="music"> موسیقی
```

**نکته مهم:**
در چک‌باکس‌ها اغلب از `[]` استفاده می‌شود چون چند مقدار ارسال می‌شود.

---

## **7) file**

برای آپلود فایل

```html
<input type="file" name="photo">
```

(به یاد داشته باشید: فرم باید enctype داشته باشد.)

---

## **8) date**

برای انتخاب تاریخ

```html
<input type="date" name="birthdate">
```

---

## **9) submit**

دکمه ارسال فرم

```html
<input type="submit" value="ارسال">
```

---

## **10) reset**

دکمه پاک کردن ورودی‌ها

```html
<input type="reset" value="پاک کردن">
```

---

# **4. تگ‌های مهم دیگر در فرم‌ها**

## **1) `<textarea>`**

برای نوشتن متن بلند (نظرات، توضیحات)

```html
<textarea name="message" rows="5" cols="40"></textarea>
```

---

## **2) `<select>` و `<option>`**

برای منوی انتخاب (dropdown)

```html
<select name="city">
    <option value="tehran">تهران</option>
    <option value="mashhad">مشهد</option>
    <option value="tabriz">تبریز</option>
</select>
```

---

# **5. صفت‌های مهم در تگ‌های ورودی (input attributes)**

### **1) name (مهم‌ترین صفت)**

برای ارسال اطلاعات به PHP لازم است.

```html
<input type="text" name="username">
```

---

### **2) value**

مقدار اولیه

```html
<input type="text" value="test">
```

---

### **3) placeholder**

متن کم‌رنگ داخل باکس

---

### **4) required**

برای اجباری کردن ورودی

```html
<input type="email" required>
```

---

### **5) readonly**

فقط نمایش می‌دهد، قابل ویرایش نیست.

---

### **6) disabled**

در فرم غیرفعال است و ارسال هم نمی‌شود.

---

### **7) maxlength / minlength**

حداکثر و حداقل تعداد کاراکتر

---

# **6. مثال کامل یک فرم HTML**

```html
<form action="result.php" method="post" enctype="multipart/form-data">

    نام:
    <input type="text" name="fullname" required><br><br>

    ایمیل:
    <input type="email" name="email"><br><br>

    رمز عبور:
    <input type="password" name="password"><br><br>

    جنسیت:
    <input type="radio" name="gender" value="male"> مرد
    <input type="radio" name="gender" value="female"> زن
    <br><br>

    علایق:
    <input type="checkbox" name="hobby[]" value="sport"> ورزش
    <input type="checkbox" name="hobby[]" value="music"> موسیقی
    <br><br>

    عکس:
    <input type="file" name="photo"><br><br>

    <input type="submit" value="ارسال">
</form>
```
