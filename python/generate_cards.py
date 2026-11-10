from PIL import Image, ImageDraw, ImageFont
import qrcode
import json
import sys
import os
import re

# ==========================================
# PATHS
# ==========================================

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
PROJECT_DIR = os.path.dirname(BASE_DIR)

TEMPLATE_D = os.path.join(BASE_DIR, "template1.png")
TEMPLATE_S = os.path.join(BASE_DIR, "template2.png")
FONT_PATH = os.path.join(BASE_DIR, "BASKVILL.ttf")
PUBLIC_FOLDER = os.path.join(PROJECT_DIR, "public")

# ==========================================
# SETTINGS
# ==========================================

NAME_Y = 545
NAME_LINE_START_X = 318
NAME_LINE_END_X = 680

QR_X = 465
QR_Y = 1300
QR_SIZE = 90

# ==========================================
# RECEIVE DATA (from a file path)
# ==========================================

if len(sys.argv) < 2:
    print(json.dumps({
        "success": False,
        "message": "No guest data received."
    }))
    sys.exit(1)

arg = sys.argv[1]

try:
    if os.path.isfile(arg):
        with open(arg, "r", encoding="utf-8") as f:
            guests = json.load(f)
    else:
        # fallback: argument is raw JSON
        guests = json.loads(arg)
except Exception as e:
    print(json.dumps({
        "success": False,
        "message": f"Could not read guest data: {e}"
    }))
    sys.exit(1)

generated = []

# ==========================================
# GENERATE
# ==========================================

guest_rows = guests.values() if isinstance(guests, dict) else guests

for row in guest_rows:

    # Skip anything that isn't a real guest object
    if not isinstance(row, dict) or "id" not in row or "guest_name" not in row:
        continue

    # Pick template by side (safe if "side" is missing)
    template_path = TEMPLATE_S if row.get("side") == "S" else TEMPLATE_D

    guest_id = row["id"]
    guest_name = row["guest_name"].strip()

    # Remove unsafe characters from folder name
    app = re.sub(r'[^a-zA-Z0-9_-]', '', row["app"])

    invitation_code = row["url"].rstrip("/")

    folder = os.path.join(PUBLIC_FOLDER, app, "cards")
    os.makedirs(folder, exist_ok=True)

    filename = f"guest_{guest_id}.png"
    output_file = os.path.join(folder, filename)
    image_url = "/" + app + "/cards/" + filename

    # ==========================================
    # CREATE QR
    # ==========================================

    qr = qrcode.QRCode(
        version=1,
        error_correction=qrcode.constants.ERROR_CORRECT_H,
        box_size=10,
        border=2
    )

    qr.add_data(invitation_code)
    qr.make(fit=True)

    qr_img = qr.make_image(
        fill_color="black",
        back_color="white"
    ).convert("RGB")

    qr_img = qr_img.resize((QR_SIZE, QR_SIZE))

    # ==========================================
    # OPEN TEMPLATE
    # ==========================================

    card = Image.open(template_path).convert("RGB")
    draw = ImageDraw.Draw(card)

    available_width = NAME_LINE_END_X - NAME_LINE_START_X

    font_size = 34

    while font_size >= 18:
        font = ImageFont.truetype(FONT_PATH, font_size)
        bbox = draw.textbbox((0, 0), guest_name, font=font)
        text_width = bbox[2] - bbox[0]

        if text_width <= available_width:
            break

        font_size -= 1

    name_x = NAME_LINE_START_X + ((available_width - text_width) // 2)

    draw.text(
        (name_x, NAME_Y),
        guest_name,
        fill=(0, 0, 0),
        font=font
    )

    card.paste(qr_img, (QR_X, QR_Y))
    card.save(output_file)

    generated.append({
        "id": guest_id,
        "guest_name": guest_name,
        "image": f"{app}/cards/{filename}",
        "image_url": image_url,
        "invitation_code": invitation_code
    })

print(json.dumps(generated))
