function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview2').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview2').hide();
            $('#imagePreview2').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload2").change(function() {
    readURL2(this);
});

function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview3').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview3').hide();
            $('#imagePreview3').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload3").change(function() {
    readURL3(this);
});

function readURL4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview4').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview4').hide();
            $('#imagePreview4').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload4").change(function() {
    readURL4(this);
});


// Personal Photo

// show  password



$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});



// Mobile flag



// $(".imgAdd").click(function() {
//     $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:143px;height:20px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
// });
$(document).on("click", "i.del", function() {
    // 	to remove card
    $(this).parent().remove();
    // to clear image
    // $(this).parent().find('.imagePreview').css("background-image","url('')");
});
// $(function() {
//     $(document).on("change", ".uploadFile", function() {
//         var uploadFile = $(this);
//         var files = !!this.files ? this.files : [];
//         if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

//         if (/^image/.test(files[0].type)) { // only image file
//             var reader = new FileReader(); // instance of the FileReader
//             reader.readAsDataURL(files[0]); // read the local file

//             reader.onloadend = function() { // set image data as background of div
//                 //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
//                 // uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
//             }
//         }

//     });
// });