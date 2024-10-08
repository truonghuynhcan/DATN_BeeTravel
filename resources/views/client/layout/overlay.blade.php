<style>
    /* Định dạng cho lớp phủ (overlay) */
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Tối màu */
        z-index: 9999;
        /* Nằm trên mọi phần tử khác */
        display: none;
        /* Ẩn đi khi chưa kích hoạt */
    }

    /* Hiệu ứng khi hiển thị overlay */
    #overlay.show {
        display: block;
    }
</style>



<div id="overlay">
    <div class="d-flex h-100 align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>



{{-- scrip sử dụng cho overlay --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lắng nghe sự kiện click trên toàn bộ tài liệu
        document.body.addEventListener('click', function(e) {
            // Kiểm tra nếu phần tử được nhấp là thẻ <a> và có thuộc tính href
            if (e.target.tagName === 'A' && e.target.href) {
                e.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a

                var overlay = document.getElementById('overlay');

                // Hiển thị overlay
                overlay.classList.add('show');

                // Chuyển hướng trang sau khi hiệu ứng hoàn tất
                setTimeout(function() {
                    window.location.href = e.target.href;
                }, 50); // 500ms cho hiệu ứng mượt
            }
        });
    });
</script>