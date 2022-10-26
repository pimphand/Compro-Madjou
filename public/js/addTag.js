jQuery(document).ready(function ($) {
    ////----- Open the modal to CREATE a link -----////
    jQuery("#btn-add").click(function () {
        jQuery("#btn-save").val("add");
        jQuery("#modalFormData").trigger("reset");
        jQuery("#tagEditorModal").modal("show");
    });

    ////----- Open the modal to UPDATE a link -----////
    jQuery("body").on("click", ".open-modal", function () {
        var tag = $(this).val();
        $.get("tags/" + tag, function (data) {
            console.log(data.id);
            jQuery("#tag_id").val(data.id);
            jQuery("#type").val(data.type);
            jQuery("#name").val(data.name);
            jQuery("#btn-save").val("update");
            jQuery("#tagEditorModal").modal("show");
        });
    });

    // Clicking the save button on the open modal for both CREATE and UPDATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
        e.preventDefault();
        var formData = {
            type: jQuery("#type").val(),
            name: jQuery("#name").val(),
        };
        var state = jQuery("#btn-save").val();
        var type = "POST";
        var tag_id = jQuery("#tag_id").val();
        var ajaxurl = "tags";
        if (state == "update") {
            type = "PUT";
            ajaxurl = "tags/" + tag_id;
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: "json",
            success: function (data) {
                var tag = "" + data.id + "" + data.type + "" + data.name + "";
                tag += "Edit ";
                tag += "Delete";
                if (state == "add") {
                    jQuery("#tags-list").append(tag);
                } else {
                    $("#tag" + tag_id).replaceWith(tag);
                }
                jQuery("#modalFormData").trigger("reset");
                jQuery("#tagEditorModal").modal("hide");
                location.reload();
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
    });

    ////----- DELETE a link and remove from the page -----////
    jQuery(".delete-link").click(function () {
        var tag_id = $(this).val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
        $.ajax({
            type: "DELETE",
            url: "tags/" + tag_id,
            success: function (data) {
                console.log(data);
                $("#tag" + tag_id).remove();
                window.location.href = "tags";
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
    });
});
