function ielts_listening(benar) {
  if (benar >= 39 && benar <= 40) {
    return 9;
  } else if (benar >= 37 && benar <= 38) {
    return 8.5;
  } else if (benar >= 35 && benar <= 36) {
    return 8;
  } else if (benar >= 32 && benar <= 34) {
    return 7.5;
  } else if (benar >= 30 && benar <= 31) {
    return 7;
  } else if (benar >= 26 && benar <= 29) {
    return 6.5;
  } else if (benar >= 23 && benar <= 25) {
    return 6;
  } else if (benar >= 18 && benar <= 22) {
    return 5.5;
  } else if (benar >= 16 && benar <= 17) {
    return 5;
  } else if (benar >= 13 && benar <= 15) {
    return 4.5;
  } else if (benar >= 11 && benar <= 12) {
    return 4;
  } else if (benar >= 8 && benar <= 10) {
    return 3.5;
  } else if (benar >= 6 && benar <= 7) {
    return 3;
  } else if (benar >= 4 && benar <= 5) {
    return 2.5;
  } else {
    return 0;
  }
}

function ielts_reading(benar, tipe_tes) {
  if (tipe_tes == "IELTS Academic") {
    if (benar >= 39 && benar <= 40) {
      return 9;
    } else if (benar >= 37 && benar <= 38) {
      return 8.5;
    } else if (benar >= 35 && benar <= 36) {
      return 8;
    } else if (benar >= 33 && benar <= 34) {
      return 7.5;
    } else if (benar >= 30 && benar <= 32) {
      return 7;
    } else if (benar >= 27 && benar <= 29) {
      return 6.5;
    } else if (benar >= 23 && benar <= 26) {
      return 6;
    } else if (benar >= 19 && benar <= 22) {
      return 5.5;
    } else if (benar >= 15 && benar <= 18) {
      return 5;
    } else if (benar >= 13 && benar <= 14) {
      return 4.5;
    } else if (benar >= 10 && benar <= 12) {
      return 4;
    } else if (benar >= 8 && benar <= 9) {
      return 3.5;
    } else if (benar >= 6 && benar <= 7) {
      return 3;
    } else if (benar >= 4 && benar <= 5) {
      return 2.5;
    } else if (benar >= 2 && benar <= 3) {
      return 2;
    } else {
      return 1;
    }
  } else if (tipe_tes == "General Training") {
    if (benar == 40) {
      return 9;
    } else if (benar == 39) {
      return 8.5;
    } else if (benar >= 37 && benar <= 38) {
      return 8;
    } else if (benar == 36) {
      return 7.5;
    } else if (benar >= 34 && benar <= 35) {
      return 7;
    } else if (benar >= 32 && benar <= 33) {
      return 6.5;
    } else if (benar >= 30 && benar <= 31) {
      return 6;
    } else if (benar >= 27 && benar <= 29) {
      return 5.5;
    } else if (benar >= 23 && benar <= 26) {
      return 5;
    } else if (benar >= 19 && benar <= 22) {
      return 4.5;
    } else if (benar >= 15 && benar <= 18) {
      return 4;
    } else if (benar >= 12 && benar <= 14) {
      return 3.5;
    } else if (benar >= 9 && benar <= 11) {
      return 3;
    } else if (benar >= 6 && benar <= 8) {
      return 2.5;
    } else if (benar >= 3 && benar <= 5) {
      return 2;
    } else {
      return 0;
    }
  }
}

function skor_ielts(
  nilai_listening,
  nilai_reading,
  nilai_writing,
  nilai_speaking
) {
  skor =
    (parseFloat(nilai_listening) +
      parseFloat(nilai_reading) +
      parseFloat(nilai_writing) +
      parseFloat(nilai_speaking)) /
    4;

  return skor;
}

function ielts_writing(
  nilai_ta_1,
  nilai_cc_1,
  nilai_gra_1,
  nilai_lr_1,
  nilai_ta_2,
  nilai_cc_2,
  nilai_gra_2,
  nilai_lr_2
) {
  let task_1 = pembulatan_skor_ielts(
    (parseFloat(nilai_ta_1) +
      parseFloat(nilai_cc_1) +
      parseFloat(nilai_gra_1) +
      parseFloat(nilai_lr_1)) /
      4
  );
  let task_2 = pembulatan_skor_ielts(
    (parseFloat(nilai_ta_2) +
      parseFloat(nilai_cc_2) +
      parseFloat(nilai_gra_2) +
      parseFloat(nilai_lr_2)) /
      4
  );

  let nilai_writing = pembulatan_skor_ielts(
    (parseFloat(task_1) + parseFloat(task_2) + parseFloat(task_2)) / 3
  );

  return nilai_writing;
}

function ielts_speaking(
  nilai_topic,
  nilai_fluency,
  nilai_grammar,
  nilai_vocabulary
) {
  let nilai_speaking = pembulatan_skor_ielts(
    (parseFloat(nilai_topic) +
      parseFloat(nilai_fluency) +
      parseFloat(nilai_grammar) +
      parseFloat(nilai_vocabulary)) /
      4
  );

  return nilai_speaking;
}

function pembulatan_skor_ielts(angka) {
  var decimal = angka - Math.floor(angka); // hitung nilai desimal

  if (decimal <= 0.25) {
    // jika desimal < 0.25
    return Math.floor(angka); // bulatkan ke bawah menjadi 0
  } else if (decimal > 0.25 && decimal <= 0.75) {
    // jika desimal >= 0.25 dan < 0.75
    return Math.floor(angka) + 0.5; // bulatkan menjadi 0.5
  } else {
    // jika desimal > 0.75
    return Math.ceil(angka); // bulatkan ke atas menjadi 1
  }
}

function writing(tipe_soal, task, url) {
  if (tipe_soal == "Soal_002") {
    if (task == 1) {
      return `
        <p class="question mb-3">
          Writing Task 1
        </p>
        <table>
            <tr>
                <td>
                    <p class='text-xs'>
                        <b>The diagram below shows the process for recycling plastic bottles.</b>
                    </p>
                    <p class='text-xs'>
                        <i>Summarise the information by selecting and reporting the main features, and make comparisons where relevant.</i>
                    </p>
                </td>

            </tr>
        </table>

        <div class="">
            <center>
                <img src="${url}public/assets/img-soal/writing-002.jpg" class='img-fluid'>
            </center>
        </div>
      `;
    } else if (task == 2) {
      return `
        <p class="question mb-3">
            Writing Task 2
        </p>

        <table>
            <tr>
                <td>
                    <p class='text-xs'>
                        <i>Some people claim that too much focus and resources have been spent to protect wild animals and birds. </i>
                    </p>
                    <p class='text-xs'>
                        <i>To what extent do you agree or disagree?</i>
                    </p>
                </td>
            </tr>
        </table>
      `;
    }
  }
}

// soal toefl
function required(form) {
  let eror = 0;
  $.each($(form + " .required"), function () {
    if ($(this).val() == "") {
      eror = 1;
      console.log($(this).attr("name"));
      $(this).addClass("bg-red-lt");
    } else {
      $(this).removeClass("bg-red-lt");
    }
  });

  return eror;
}
