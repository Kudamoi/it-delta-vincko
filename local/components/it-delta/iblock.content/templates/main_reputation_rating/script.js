var reputationRatingFilter = {
    setFilter: function () {
        var str = document.querySelector(".reputation__rating_select-js");
        reputationRatingFilter.setGlobalCity();
    },

    setGlobalCity: function() {
        $.ajax({
            url: "/ajax/citymodal.php",
            type: "POST",
            data: {
                city: document.querySelector(".reputation__rating_select-js").value
            },
            dataType: "json",
            success: function(d){
                location.reload();
            },
            error: function(e){
                location.reload();
            }
        });
    },
};