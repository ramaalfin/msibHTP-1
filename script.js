//inisialisasi variabel pegawai
let pegawai = "Rama Alfin Baehaqi";
let jabatan = "Manager";
let status = "belum menikah";

//inisialisasi variabel gaji
let gajiPokok = 0;
let tunjanganJabatan = 0;
let bpjs = 0;
let tunjanganKeluarga = 0;
let totalPenghasilan = 0;

//menghitung gaji pokok
if(jabatan === "Manager") {
  gajiPokok = 10000000;
} else if(jabatan === "Asisten manager") {
  gajiPokok = 8000000;
} else if(jabatan === "Staff") {
  gajiPokok = 5000000;
}

//menghitung tunjangan jabatan
tunjanganJabatan = 0.1 * gajiPokok;

//menghitung BPJS
bpjs = 0.1 * gajiPokok;

//menghitung tunjangan keluarga
if(status === "menikah") {
  tunjanganKeluarga = 0.1 * gajiPokok;
}

//menghitung total penghasilan
totalPenghasilan = gajiPokok + tunjanganJabatan + bpjs + tunjanganKeluarga;

//cetak data pegawai dan gaji
document.write("Pegawai : " + pegawai + "<br>");
document.write("Jabatan : " + jabatan + "<br>");
document.write("Gaji Pokok : " + gajiPokok + "<br>");
document.write("Tunjangan Jabatan : " + tunjanganJabatan + "<br>");
document.write("BPJS : " + bpjs + "<br>");
document.write("Tunjangan Keluarga : " + tunjanganKeluarga + "<br>");
document.write("Total Penghasilan : " + totalPenghasilan);
