<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website')</title>
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">

    @include('components.header')
    @include('components.banner')
    <!-- Hiển thị danh mục sản phẩm -->
    @include('components.showproducts', ['categories' => $categories, 'products' => $products])
    @include('components.footer')


    <!-- Bạn có thể thêm footer ở đây -->
</body>

</html>