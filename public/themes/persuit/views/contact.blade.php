@sections('header')
        
@sections('categories-solid')
        
        <!--================Contact Area =================-->
        <section class="contact_area p_100">
            <div class="container">
                <div class="contact_title">
                    <h2>Liên hệ</h2>
                    <p>Mỹ phẩm Persuit - Chất lượng cho tất cả</p>
                </div>
                <div class="row contact_details">
                    <div class="col-lg-4 col-md-6">
                        <div class="media">
                            <div class="d-flex">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <p>Nhà # 402, Phố RB,<br />Hà Nội, Việt Nam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="media">
                            <div class="d-flex">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <a href="tel:+1109171234567">0912 345 678</a>
                                <a href="tel:+1101911897654">0987 654 321</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="media">
                            <div class="d-flex">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <a href="mailto:busines@persuit.com">busines@persuit.com</a>
                                <a href="mailto:support@persuit.com">support@persuit.com</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact_form_inner">
                    <h3>Gửi tin nhắn</h3>
                    <form class="contact_us_form row" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                        <div class="form-group col-lg-4">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên *">
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email *">
                        </div>
                        <div class="form-group col-lg-12">
                            <textarea class="form-control" name="message" id="message" rows="1" placeholder="Tin nhắn của bạn..."></textarea>
                        </div>
                        <div class="form-group col-lg-12">
                            <button type="submit" value="submit" class="btn update_btn form-control">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!--================End Contact Area =================-->
        
@sections('footer')               
        
        <!--================Contact Success and Error message Area =================-->
        <div id="success" class="modal modal-message fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>
                        <h2>Cảm ơn</h2>
                        <p>Tin nhắn của bạn đã được gửi thành công</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals error -->

        <div id="error" class="modal modal-message fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>
                        <h2>Xin lỗi !</h2>
                        <p> Có sự cố xảy ra </p>
                    </div>
                </div>
            </div>
        </div>
        <!--================End Contact Success and Error message Area =================-->