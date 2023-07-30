import requests

link = "https://gitlab.com/kalilinux/packages/wordlists/-/raw/kali/master/rockyou.txt.gz?ref_type=heads"
nama_file = "rockyou.txt.gz"

try:
  response = requests.get(link)
  response.raise_for_status()
  with open(nama_file, 'wb') as file:
    file.write(response.content)
    print("Download completed!")
except requests.exceptions.RequestException as e:
  print(f"Error occurred: {e}")
