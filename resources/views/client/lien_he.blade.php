@extends('client.layout.index')
@section('title')
    Liên hệ
@endsection
@section('main')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
    }

    .contact-container {
        position: relative;
        width: 70%;
        max-width: 1200px;
        background: rgba(6, 121, 159, 0.892);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        margin: 30px auto;
    }

    .contact-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        overflow: hidden;
    }

    .contact-background img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.5;
    }

    .contact-content {
        position: relative;
        z-index: 2;
        display: flex;
        gap: 20px;
        padding: 20px;
    }

    .contact-info, .contact-form {
        flex: 1;
        padding: 20px;
        color: #fff;
    }

    .contact-info {
        border-right: 1px solid rgba(255, 255, 255, 0.3);
    }

    .contact-info h2, .contact-form h2 {
        margin-bottom: 15px;
        color: #fff;
    }

    .contact-form .form-group {
        margin-bottom: 15px;
    }

    .contact-form input, .contact-form textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
    }

    .contact-form button {
        padding: 10px 170px;
        background-color: #007bff;
        border: none;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    .contact-form button:hover {
        background-color: #0056b3;
    }

    #map-container {
        width: 70%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background: rgba(173, 216, 230, 0.7);
        border-radius: 10px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
    }

    #map {
        border-radius: 10px;
    }
</style>
<div class="contact-container">
    <div class="contact-background">
        <img src="{{asset('')}}assets/image/contact.jpg" alt="Contact Background">
    </div>
    <div class="contact-content">
        <div class="contact-info">
            <h2>BEE TRAVEL</h2>
            <p><strong>Địa chỉ:</strong> QTSC 1, Phường Tân Chánh Hiệp, Quận 12, TP.HCM</p>
            <p><strong>Website:</strong> beetravel.com</p>
            <p><strong>Email:</strong> info@beetravel.com</p>
            <p><strong>Điện thoại:</strong> 0123 456 789</p>
        </div>
        <div class="contact-form">
            <h2>Liên hệ với chúng tôi</h2>
            <form action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="message">Nội dung</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit">Gửi thông tin</button>
            </form>
        </div>
    </div>
</div>
<div id="map-container">
    <h2>Vị trí của chúng tôi</h2>
    <div id="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14513.154484468258!2d106.6535512472342!3d10.829012150757082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529111aa89f9d%3A0xd8f09cc0aa1b27f3!2zQ-G6o25nIGjDoG5nIGtow7RuZyBxdeG7kWMgdOG6vyBUw6JuIFPGoW4gTmjhuqV0!5e0!3m2!1svi!2s!4v1727707229007!5m2!1svi!2s" width="100%" height="450px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
@endsection