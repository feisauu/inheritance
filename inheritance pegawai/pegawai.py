import tkinter as tk

class Pegawai:
    def __init__(self, nama, nik, alamat, jenis_kelamin, gaji_pokok):
        self.nama = nama
        self.nik = nik
        self.alamat = alamat
        self.jenis_kelamin = jenis_kelamin
        self.gaji_pokok = gaji_pokok

    def info(self):
        return f"Nama: {self.nama}\nNIK: {self.nik}\nAlamat: {self.alamat}\nJenis Kelamin: {self.jenis_kelamin}\nGaji Pokok: {self.gaji_pokok}"

class PegawaiTetap(Pegawai):
    def __init__(self, nama, nik, alamat, jenis_kelamin, gaji_pokok, tunjangan):
        super().__init__(nama, nik, alamat, jenis_kelamin, gaji_pokok)
        self.tunjangan = tunjangan

    def info(self):
        gaji_total = self.gaji_pokok + self.tunjangan
        return super().info() + f"\nTunjangan: {self.tunjangan}\nGaji Total: {gaji_total}"

class PegawaiKontrak(Pegawai):
    def __init__(self, nama, nik, alamat, jenis_kelamin, gaji_pokok, kontrak):
        super().__init__(nama, nik, alamat, jenis_kelamin, gaji_pokok)

class PegawaiHarian(Pegawai):
    def __init__(self, nama, nik, alamat, jenis_kelamin, gaji_pokok):
        super().__init__(nama, nik, alamat, jenis_kelamin, gaji_pokok)

def tampilkan_info():
    nama = entry_nama.get()
    nik = entry_nik.get()
    alamat = entry_alamat.get()
    jenis_kelamin = var_jenis_kelamin.get()
    jenis_pegawai = var_jenis_pegawai.get()
    gaji_pokok = int(entry_gaji.get())

    if jenis_pegawai == "Tetap":
        tunjangan = int(entry_tunjangan.get())
        kontrak = ""
        pegawai = PegawaiTetap(nama, nik, alamat, jenis_kelamin, gaji_pokok, tunjangan)
    elif jenis_pegawai == "Kontrak":
        kontrak = entry_kontrak.get()
        pegawai = PegawaiKontrak(nama, nik, alamat, jenis_kelamin, gaji_pokok, kontrak)
    elif jenis_pegawai == "Harian":
        kontrak = ""  # Mengosongkan nilai kontrak saat jenis pegawai adalah Harian
        pegawai = PegawaiHarian(nama, nik, alamat, jenis_kelamin, gaji_pokok)

    info = pegawai.info()

    if jenis_pegawai and jenis_pegawai != "Kontrak":
        info += f"\nJenis Pegawai: {jenis_pegawai}"
    if kontrak:
        info += f"\nKontrak Kerja: {kontrak}"

    hasil.config(text=info)

root = tk.Tk()
root.title("Sistem Informasi Pegawai")

frame = tk.Frame(root)
frame.pack(pady=10)

label_nama = tk.Label(frame, text="Nama:")
label_nama.grid(row=0, column=0, sticky="w")

entry_nama = tk.Entry(frame)
entry_nama.grid(row=0, column=1)

label_nik = tk.Label(frame, text="NIK:")
label_nik.grid(row=1, column=0, sticky="w")

entry_nik = tk.Entry(frame)
entry_nik.grid(row=1, column=1)

label_alamat = tk.Label(frame, text="Alamat:")
label_alamat.grid(row=2, column=0, sticky="w")

entry_alamat = tk.Entry(frame)
entry_alamat.grid(row=2, column=1)

label_jenis_kelamin = tk.Label(frame, text="Jenis Kelamin:")
label_jenis_kelamin.grid(row=3, column=0, sticky="w")

var_jenis_kelamin = tk.StringVar(root)
var_jenis_kelamin.set("Laki-Laki")

jenis_kelamin = tk.OptionMenu(frame, var_jenis_kelamin, "Laki-Laki", "Perempuan")
jenis_kelamin.grid(row=3, column=1)

label_gaji = tk.Label(frame, text="Gaji Pokok:")
label_gaji.grid(row=4, column=0, sticky="w")

entry_gaji = tk.Entry(frame)
entry_gaji.grid(row=4, column=1)

label_jenis_pegawai = tk.Label(frame, text="Jenis Pegawai:")
label_jenis_pegawai.grid(row=5, column=0, sticky="w")

var_jenis_pegawai = tk.StringVar(root)
var_jenis_pegawai.set("Tetap")

jenis_pegawai = tk.OptionMenu(frame, var_jenis_pegawai, "Tetap", "Kontrak", "Harian")
jenis_pegawai.grid(row=5, column=1)

label_tunjangan = tk.Label(frame, text="Tunjangan (Tetap):")
label_tunjangan.grid(row=6, column=0, sticky="w")

entry_tunjangan = tk.Entry(frame)
entry_tunjangan.grid(row=6, column=1)

label_kontrak = tk.Label(frame, text="Kontrak Kerja (dalam bulan): ")
label_kontrak.grid(row=7, column=0, sticky="w")

entry_kontrak = tk.Entry(frame)
entry_kontrak.grid(row=7, column=1)

btn_hitung = tk.Button(frame, text="Tampilkan Info", command=tampilkan_info)
btn_hitung.grid(row=8, columnspan=2)

hasil = tk.Label(root, text="", justify="left")
hasil.pack(pady=10)

root.mainloop()

