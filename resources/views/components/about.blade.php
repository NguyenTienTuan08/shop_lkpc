<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu - KEN STORE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800">
    @include('components.header')

    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-blue-700">Giới Thiệu Về KEN STORE</h1>
            <p class="text-lg mt-4 text-gray-600">Chúng tôi là đơn vị chuyên cung cấp linh kiện máy tính hàng đầu tại Việt Nam</p>
        </div>

        <div class="grid md:grid-cols-2 gap-10">
            <div>
                <img src="{{ asset('images/linh-kien-may-tinh-1.jpg') }}" alt="Office" class="rounded-lg shadow-md">
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-blue-600 mb-4">Về Chúng Tôi</h2>
                <p class="mb-4 leading-relaxed">
                    KEN STORE được thành lập vào năm 2015 với mục tiêu mang đến cho khách hàng những sản phẩm linh kiện máy tính chính hãng, chất lượng cao với giá thành hợp lý.
                </p>
                <p class="mb-4 leading-relaxed">
                    Với hơn <span class="font-bold text-blue-700">8 năm kinh nghiệm</span> trong ngành công nghệ, chúng tôi tự hào là đối tác tin cậy của hàng ngàn khách hàng trên khắp cả nước.
                </p>
                <p class="leading-relaxed">
                    Đội ngũ nhân viên kỹ thuật và tư vấn viên chuyên nghiệp của chúng tôi luôn sẵn sàng hỗ trợ và mang lại trải nghiệm mua sắm tuyệt vời nhất cho quý khách.
                </p>
            </div>
        </div>

        <div class="mt-16 text-center">
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Tại Sao Chọn KEN STORE?</h2>
            <div class="grid md:grid-cols-3 gap-8 mt-6">
                <div class="bg-white shadow-lg p-6 rounded-lg hover:shadow-xl transition">
                    <h3 class="text-xl font-bold mb-2 text-blue-500">Sản phẩm chất lượng</h3>
                    <p>Cam kết hàng chính hãng, bảo hành đầy đủ từ nhà sản xuất.</p>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-lg hover:shadow-xl transition">
                    <h3 class="text-xl font-bold mb-2 text-blue-500">Giá cả cạnh tranh</h3>
                    <p>Chính sách giá hợp lý, nhiều ưu đãi cho khách hàng thân thiết.</p>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-lg hover:shadow-xl transition">
                    <h3 class="text-xl font-bold mb-2 text-blue-500">Hỗ trợ tận tâm</h3>
                    <p>Hỗ trợ tư vấn kỹ thuật, bảo hành và chăm sóc khách hàng 24/7.</p>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
</body>

</html>