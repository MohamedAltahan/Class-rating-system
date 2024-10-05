$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("body").on("click", ".post-comment", function (e) {
        let url = $(this).data("url");
        $.ajax({
            method: "GET",
            url,
            data: {},
            success: function (data) {
                $(".show-comments").html(data);
                $("#comments-modal").modal("show");
            },
            error: function (error) {
                alert("e");
            },
        });
    });

    $("body").on("click", "#add-comment-btn", function (e) {
        let url = $(this).data("url");
        let commentBody = $("#comment_body").val();
        if (commentBody == "") {
            return false;
        }
        let postId = $("#post_id").val();
        console.log(url + "/" + postId);
        $.ajax({
            method: "post",
            url,
            data: {
                postId,
                commentBody,
            },
            success: function (data) {
                $("#comment-list").load(url + "/" + postId);
                $("#comment_body").val("");
            },
            error: function (error) {
                alert("error");
            },
        });
    });

    $("body").on("click", ".delete-comment", function (e) {
        e.preventDefault();
        let url = $(this).attr("href");
        $.ajax({
            method: "DELETE",
            url: url,
            data: {},
            success: function (data) {
                location.reload();
            },
            error: function (error) {
                alert("error");
            },
        });
    });
});
