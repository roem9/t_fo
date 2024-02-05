// class rupiah untuk format rupiah
$(document).on("keyup", ".rupiah", function () {
  $(this).val(formFormatRupiah(this.value, "Rp. "));
});

$.fn.inputFilter = function (inputFilter) {
  return this.on(
    "input keydown keyup mousedown mouseup select contextmenu drop",
    function () {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    }
  );
};

// number only
$(".number").inputFilter(function (value) {
  return /^\d*$/.test(value); // Allow digits only, using a RegExp
});

// function formatRupiah(amount) {
//   return "Rp " + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
// }
