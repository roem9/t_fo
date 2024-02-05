function formFormatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

function formatRupiah(angka, prefix) {
	// Check if angka is a negative number
	var isNegative = angka < 0;
	angka = Math.abs(angka);

	var number_string = angka.toString().replace(/[^,\d]/g, ""),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// Add a dot (.) if the input is already a thousand separator
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;

	// Enclose the value in parentheses if it's negative
	if (isNegative) {
		rupiah = "(" + rupiah + ")";
	}

	return prefix === undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}

function dateIndo(date) {
	var tglBaru = date.split("-").reverse().join("-");

	return tglBaru;
}

// input filters
function setInputFilter(textbox, inputFilter) {
	[
		"input",
		"keydown",
		"keyup",
		"mousedown",
		"mouseup",
		"select",
		"contextmenu",
		"drop",
	].forEach(function (event) {
		textbox.addEventListener(event, function () {
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
		});
	});
}

//format rupiah
// function formatRupiah(angka, prefix){
//     var number_string = angka.replace(/[^,\d]/g, '').toString(),
//     split   		= number_string.split(','),
//     sisa     		= split[0].length % 3,
//     rupiah     		= split[0].substr(0, sisa),
//     ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

//     // tambahkan titik jika yang di input sudah menjadi angka ribuan
//     if(ribuan){
//         separator = sisa ? '.' : '';
//         rupiah += separator + ribuan.join('.');
//     }

//     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
//     return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
// }

// modal edit status tagihan
$(".modal_edit_status_tagihan").click(function () {
	let data = $(this).data("id");
	data = data.split("|");
	let id = data[0];
	let status = data[1];
	$("#id_edit_tagihan").val(id);
	$("#status_tagihan").val(status);
});
// modal edit status tagihan
