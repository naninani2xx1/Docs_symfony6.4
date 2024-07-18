# Asset mapper components
***
**Table content**:
1. how it's work?
2. Performance.
3. How it's use?
### How it's work?
> php bin/console asset-map:compile

`It's will be help build css, js, vendor from folder assets/ into public/ in the project`
> php bin/console debug:asset-map

`Debug asset mapper`

***
### Performance
Để hiểu vấn đề này, hãy tưởng tượng thiết lập lý thuyết sau:

##### assets/app.jsnhập khẩu./duck.js 
##### assets/duck.jsnhập khẩubootstrap
Nếu không tải trước, khi trình duyệt tải trang xuống, điều sau đây sẽ xảy ra:

Trình duyệt tải xuống assets/app.js;
Sau đó nó sẽ thấy việc ./duck.jsnhập và tải xuống assets/duck.js;
Sau đó nó sẽ xem xét bootstrapviệc nhập và tải xuống assets/bootstrap.js.
Thay vì tải xuống cả 3 tệp song song, trình duyệt sẽ buộc phải tải xuống từng tệp một khi phát hiện ra chúng. Điều đó sẽ làm giảm hiệu suất.

AssetMapper tránh vấn đề này bằng cách xuất ra linkcác thẻ "tải trước". Logic hoạt động như sau:

A) Khi bạn gọi importmap('app')trong mẫu của mình , thành phần AssetMapper sẽ xem xét tệp assets/app.jsvà tìm tất cả các tệp JavaScript mà nó nhập hoặc các tệp mà các tệp đó nhập, v.v.

B) Sau đó, nó sẽ xuất ra một linkthẻ cho mỗi tệp đó với một rel="preload" thuộc tính. Điều này sẽ yêu cầu trình duyệt bắt đầu tải xuống các tệp đó ngay lập tức, mặc dù nó vẫn chưa thấy câu importlệnh cho chúng.
***
### How it's use?
    //base.html.twig
    {% block javascripts %}
        {% block importmap %}{{ importmap('dashboard') }}{% endblock %}
    {% endblock %}

    //importmap.php
    return [
        'app' => [
            'path' => './assets/app.js',
            'entrypoint' => true,
        ],
        'dashboard' => [
            'path' => './assets/dashboard.js',
            'entrypoint' => true,
    ];
    // assets/dashboard.js
    import './themes/assets/plugins/global/plugins.bundle.css';
    import './themes/assets/css/style.bundle.css'

[Tìm hiểu thêm](https://symfony.com/doc/6.4/frontend/asset_mapper.html#performance-understanding-preloading)