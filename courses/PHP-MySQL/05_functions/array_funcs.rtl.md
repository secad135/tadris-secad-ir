# **جزوه آموزشی توابع آرایه‌ها در PHP**

### **دسته‌بندی کلی توابع آرایه:**

---

## **📝 دسته ۱: افزودن و حذف عناصر**

### **۱. array_push()** - افزودن به انتهای آرایه
```php
$colors = ["red", "blue"];
array_push($colors, "green", "yellow");
print_r($colors);
// خروجی: Array ( [0] => red [1] => blue [2] => green [3] => yellow )
```

### **۲. array_pop()** - حذف از انتهای آرایه
```php
$colors = ["red", "blue", "green"];
$last = array_pop($colors);
echo $last; // خروجی: green
print_r($colors); // خروجی: Array ( [0] => red [1] => blue )
```

### **۳. array_unshift()** - افزودن به ابتدای آرایه
```php
$colors = ["red", "blue"];
array_unshift($colors, "green");
print_r($colors);
// خروجی: Array ( [0] => green [1] => red [2] => blue )
```

### **۴. array_shift()** - حذف از ابتدای آرایه
```php
$colors = ["red", "blue", "green"];
$first = array_shift($colors);
echo $first; // خروجی: red
print_r($colors); // خروجی: Array ( [0] => blue [1] => green )
```

---

## **🔍 دسته ۲: جستجو و بررسی**

### **۵. in_array()** - بررسی وجود مقدار در آرایه
```php
$numbers = [1, 2, 3, 4, 5];
if(in_array(3, $numbers)) {
    echo "عدد 3 در آرایه وجود دارد";
} else {
    echo "عدد 3 در آرایه وجود ندارد";
}
```

### **۶. array_search()** - جستجوی مقدار و برگرداندن کلید
```php
$colors = ["red", "blue", "green"];
$key = array_search("blue", $colors);
echo $key; // خروجی: 1
```

### **۷. array_key_exists()** - بررسی وجود کلید در آرایه
```php
$student = ["name" => "آرمان", "age" => 15];
if(array_key_exists("name", $student)) {
    echo "کلید name وجود دارد";
}
```

---

## **🔄 دسته ۳: تغییر و تبدیل آرایه**

### **۸. array_map()** - اعتاب تابع روی همه عناصر
```php
$numbers = [1, 2, 3, 4];
$squared = array_map(function($num) {
    return $num * $num;
}, $numbers);
print_r($squared);
// خروجی: Array ( [0] => 1 [1] => 4 [2] => 9 [3] => 16 )
```

### **۹. array_filter()** - فیلتر کردن آرایه
```php
$numbers = [1, 2, 3, 4, 5, 6];
$even = array_filter($numbers, function($num) {
    return $num % 2 == 0;
});
print_r($even);
// خروجی: Array ( [1] => 2 [3] => 4 [5] => 6 )
```

### **۱۰. array_merge()** - ادغام آرایه‌ها
```php
$array1 = ["a", "b"];
$array2 = ["c", "d"];
$result = array_merge($array1, $array2);
print_r($result);
// خروجی: Array ( [0] => a [1] => b [2] => c [3] => d )
```

---

## **📊 دسته ۴: اطلاعات و آمار**

### **۱۱. count()** - شمارش تعداد عناصر
```php
$colors = ["red", "blue", "green"];
echo count($colors); // خروجی: 3
```

### **۱۲. array_sum()** - جمع مقادیر آرایه
```php
$numbers = [1, 2, 3, 4, 5];
echo array_sum($numbers); // خروجی: 15
```

### **۱۳. array_product()** - ضرب مقادیر آرایه
```php
$numbers = [2, 3, 4];
echo array_product($numbers); // خروجی: 24
```

---

## **🎯 دسته ۵: مرتب‌سازی**

### **۱۴. sort()** - مرتب‌سازی صعودی
```php
$numbers = [4, 2, 8, 1];
sort($numbers);
print_r($numbers);
// خروجی: Array ( [0] => 1 [1] => 2 [2] => 4 [3] => 8 )
```

### **۱۵. rsort()** - مرتب‌سازی نزولی
```php
$numbers = [4, 2, 8, 1];
rsort($numbers);
print_r($numbers);
// خروجی: Array ( [0] => 8 [1] => 4 [2] => 2 [3] => 1 )
```

### **۱۶. array_reverse()** - معکوس کردن آرایه
```php
$colors = ["red", "blue", "green"];
$reversed = array_reverse($colors);
print_r($reversed);
// خروجی: Array ( [0] => green [1] => blue [2] => red )
```

---

## **🔑 دسته ۶: کار با کلیدها و مقادیر**

### **۱۷. array_keys()** - گرفتن کلیدهای آرایه
```php
$student = ["name" => "آرمان", "age" => 15, "grade" => "دهم"];
$keys = array_keys($student);
print_r($keys);
// خروجی: Array ( [0] => name [1] => age [2] => grade )
```

### **۱۸. array_values()** - گرفتن مقادیر آرایه
```php
$student = ["name" => "آرمان", "age" => 15, "grade" => "دهم"];
$values = array_values($student);
print_r($values);
// خروجی: Array ( [0] => آرمان [1] => 15 [2] => دهم )
```
