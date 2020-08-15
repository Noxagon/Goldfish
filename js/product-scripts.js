var inputReview = document.getElementById("reviewMessage");

const reviewHandler = function (e) {
    if (e.target.value.length > 0) {
        document.getElementById("submit_btn").disabled = false;
    } else {
        document.getElementById("submit_btn").disabled = true;
    }
}

inputReview.addEventListener('input', reviewHandler);
inputReview.addEventListener('propertychange', reviewHandler);

function toggle(id) {
    var ab = document.getElementById(id + "_hidden").value;
    document.getElementById("reviewRatings").value = ab;

    for (var i = ab; i >= 1; i--) {
        //document.getElementById(cname+i).src="star2.png";
        document.getElementById("star" + i).style.color = "orange";
    }
    var id = parseInt(ab) + 1;
    for (var j = id; j <= 5; j++) {
        //document.getElementById(cname+j).src="star1.png";
        document.getElementById("star" + j).style.color = "black";
    }
}

// $(document).ready(function () {
//     $("#reviewForm").submit(function(e) {
//         e.preventDefault();
//         $.ajax({
//             url : $(this).attr('action') || window.location.pathname,
//             type: "POST",
//             data: $(this).serialize(),
//             success: function (data) {
//                 alert("Successful");
//             },
//             error: function (jXHR, textStatus, errorThrown) {
//                 alert(errorThrown);
//             }
//         });
//     });
// });