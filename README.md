## Pengaturan database

### nama database: freshleaf

## .env untuk aplikasi
### app maintenance, cache : file


## Setting untuk midtrans payment gateway

### untuk pembayaran, hanya menggunakan sandbox. karena keterbatasan waktu dan kemampuan, belum bisa menggunakan callback untuk notifikasi pembayaran dari server midtrans, masih mengubah status pembayaran secara manual dari aplikasi

### .env untuk midtrans
```
MIDTRANS_SERVER_KEY=SB-Mid-server-CCU2Gn29QgoQpO_oSmy_nFT_
MIDTRANS_CLIENT_KEY=SB-Mid-client-_zFwUZcICfvp5rJk
```

