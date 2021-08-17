var HeaderFilter = {

    setFilter: function () {
        var str = $("#b-header_filter").serialize();
        var arrayOfStrings = str.split('&');
        arrayOfStrings.forEach(function (element) {
            let s = element.split('=');
            BX.setCookie(s[0], s[1], {expires: 86400, path: '/'});
        });
        HeaderFilter.setGlobalCity();
    },
    setGlobalCity: function() {
            $.ajax({
                url: "/ajax/citymodal.php",
                type: "POST",
                data: {
                    city: $("#header__select_location-js :selected").data("id")
                },
                dataType: "json",
                success: function(d){
                    location.href = "/raiting/#rating";
                },
                error: function(e){
                    location.href = "/raiting/#rating";
                }
            });

    },
};