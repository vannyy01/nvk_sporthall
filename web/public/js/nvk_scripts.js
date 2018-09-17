(($) =>
    $(document).ready(() => {
        $("#gallery").unitegallery({
            theme_enable_preloader: true,
            gallery_theme: "tiles"
        });
    }))(jQuery);

(($) =>
    $(window).scroll(
        () => {
            let scrollTop = -$(this).scrollTop();
            $('.masthead').css('background-position-y', 0.4 * scrollTop);
        }
    ))(jQuery);


(($) =>
    $(window).ready(() =>{
        $(".sport-photos").on("click", (e) => {
            const photosSrc = e.target.getAttribute("src");
            const image = new Image();
            image.src = photosSrc;
            const width = image.width;
            const height = image.height;
            window.open(photosSrc, "Image", "width=" + width + ",height=" + height);
        })}
    ))(jQuery);

