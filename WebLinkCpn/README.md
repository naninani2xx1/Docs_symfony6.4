`prefetch` và `prerender` đều là
cơ chế giúp tăng tốc độ tải trang web
bằng cách tải trước các tài nguyên.
Tuy nhiên, chúng có mục đích và mức độ
tải trước khác nhau:
***

# **prefetch**

1. **_`Mục đích`_**: prefetch được sử dụng để tải trước các tài nguyên mà có thể được yêu cầu trong tương lai. Điều này giúp giảm thời gian tải khi các tài nguyên này thực sự được yêu cầu.
2. `Hoạt động`: Tài nguyên được tải xuống và lưu trong bộ nhớ cache của trình duyệt. Khi người dùng điều hướng tới trang hoặc tài nguyên đó, trình duyệt có thể sử dụng phiên bản đã lưu trong bộ nhớ cache, giúp trang tải nhanh hơn.
3. `Ứng dụng:` Thường được sử dụng cho các tài nguyên như ảnh, tệp JavaScript, CSS, hoặc các trang web mà có khả năng cao sẽ được người dùng truy cập tiếp theo nhưng không cần phải tải ngay lập tức.
  

    {# tải trước #}
    <link rel="preload" href="{{ preload(asset('styles/app.css'), { as: 'style' }) }}">
    {# Liên kết thực tế để tải tệp CSS #}
    <link rel="stylesheet" href="{{ asset('styles/app.css') }}">


***

# prerender

1. `Mục đích`: prerender không chỉ tải trước tài nguyên mà còn thực thi chúng trong nền. Khi người dùng điều hướng tới trang đó, trang gần như đã sẵn sàng và có thể hiển thị ngay lập tức.
2. `Hoạt động`: Tài nguyên được tải xuống, HTML được phân tích cú pháp và các tệp CSS, JavaScript được thực thi. Điều này có nghĩa là trình duyệt chuẩn bị trang ở mức độ rất cao, gần như sẵn sàng để hiển thị.
3. `Ứng dụng`: Thường được sử dụng cho các trang đích mà người dùng gần như chắc chắn sẽ truy cập tiếp theo, chẳng hạn như trang thanh toán sau khi thêm sản phẩm vào giỏ hàng.