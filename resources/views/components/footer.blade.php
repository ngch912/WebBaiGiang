<!-- resources/views/components/footer.blade.php -->
<footer>
    <p>&copy; 2025 Hệ Thống Web Bài Giảng. Tất cả quyền được bảo lưu.</p>
    <p>Địa chỉ: 65 Huỳnh Thúc Kháng, Quận 1, Thành phố Hồ Chí Minh, Việt Nam</p>
</footer>

<style>
    /* Footer */
    footer {
        background-color: #2c3e50;
        color: white;
        text-align: center;
        padding: 15px;
        margin-top: auto;  /* Đảm bảo footer luôn ở dưới cùng */
        width: 100%;
        position: relative;  /* Đảm bảo footer luôn nằm cuối cùng */
    }

    /* Đảm bảo footer luôn ở dưới cùng của trang khi nội dung ít */
    body {
        display: flex;
        flex-direction: column;  /* Đặt các phần tử theo chiều dọc */
        justify-content: space-between;  /* Các phần tử được phân bổ đều */
        min-height: 100vh;  /* Đảm bảo chiều cao đầy đủ */
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fc;
        color: #2c3e50;
    }

    /* Các phần tử trong body (header, nav, content, footer) */
    main {
        flex: 1;  /* Đảm bảo rằng phần chính chiếm không gian còn lại */
    }
</style>
