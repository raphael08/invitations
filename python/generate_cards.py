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

TEMPLATE = os.path.join(BASE_DIR, "template.png")
FONT_PATH = os.path.join(BASE_DIR, "BASKVILL.ttf")

PUBLIC_FOLDER = os.path.join(PROJECT_DIR, "public")

# ==========================================
# SETTINGS
# ==========================================

# NAME_Y = 634

# NAME_LINE_START_X = 319
# NAME_LINE_END_X = 634

# QR_X = 422
# QR_Y = 1172
# QR_SIZE = 170

NAME_Y = 650

# Start and end of the name line
NAME_LINE_START_X = 318
NAME_LINE_END_X = 680

# QR position
QR_X = 420
QR_Y = 1270
QR_SIZE = 160

# ==========================================
# RECEIVE DATA
# ==========================================

if len(sys.argv) < 2:
    print(json.dumps({
        "success": False,
        "message": "No guest data received."
    }))
    sys.exit()

guests = json.loads(sys.argv[1])

generated = []

# ==========================================
# GENERATE
# ==========================================

# ==========================================
# GENERATE
# ==========================================

# Handle both JSON array lists or associative object dictionary variations defensively
guest_rows = guests.values() if isinstance(guests, dict) else guests

# print(guest_rows)
for row in guest_rows:

    # Safely bypass any metadata properties that are not actual guest objects
    if not isinstance(row, dict) or "id" not in row or "guest_name" not in row:
        continue

    guest_id = row["id"]
    guest_name = row["guest_name"].strip()

    # Remove unsafe characters from folder name
    app = re.sub(r'[^a-zA-Z0-9_-]', '', row["app"])

    invitation_code = (
        row["url"].rstrip("/")
        + "/"
        + app
        + "/"
        + row["invitation_token"]
    )

    folder = os.path.join(
        PUBLIC_FOLDER,
        app,
        "cards"
    )

    # Create public/{app}/cards
    os.makedirs(folder, exist_ok=True)

    filename = f"guest_{guest_id}.png"

    output_file = os.path.join(
        folder,
        filename
    )

    image_url = (
        row["url"].rstrip("/")
        + "/"
        + app
        + "/cards/"
        + filename
    )

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

    card = Image.open(TEMPLATE).convert("RGB")

    draw = ImageDraw.Draw(card)

    available_width = (
        NAME_LINE_END_X -
        NAME_LINE_START_X
    )

    font_size = 34

    while font_size >= 18:

        font = ImageFont.truetype(
            FONT_PATH,
            font_size
        )

        bbox = draw.textbbox(
            (0, 0),
            guest_name,
            font=font
        )

        text_width = bbox[2] - bbox[0]

        if text_width <= available_width:
            break

        font_size -= 1

    name_x = (
        NAME_LINE_START_X +
        ((available_width - text_width) // 2)
    )

    draw.text(
        (name_x, NAME_Y),
        guest_name,
        fill=(0, 0, 0),
        font=font
    )

    card.paste(
        qr_img,
        (QR_X, QR_Y)
    )

    card.save(output_file)

    generated.append({
        "id": guest_id,
        "guest_name": guest_name,
        "image": f"{app}/cards/{filename}",
        "image_url": image_url,
        "invitation_code": invitation_code
    })

print(json.dumps(generated))
