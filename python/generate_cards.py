from PIL import Image, ImageDraw, ImageFont
import qrcode
import hashlib
import json
import sys
import os

# ==========================================
# PATHS
# ==========================================

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
PROJECT_DIR = os.path.dirname(BASE_DIR)

TEMPLATE = os.path.join(BASE_DIR, "template.png")
FONT_PATH = os.path.join(BASE_DIR, "ariali.ttf")

OUTPUT_FOLDER = os.path.join(PROJECT_DIR, "public", "cards")

os.makedirs(OUTPUT_FOLDER, exist_ok=True)

# ==========================================
# SETTINGS
# ==========================================

NAME_Y = 634

NAME_LINE_START_X = 319
NAME_LINE_END_X = 634

QR_X = 422
QR_Y = 1172
QR_SIZE = 170

# ==========================================
# RECEIVE DATA
# ==========================================

guests = json.loads(sys.argv[1])

print(guests)

generated = []

# ==========================================
# LOOP
# ==========================================

for row in guests:

    guest_id = row["id"]
    guest_name = row["guest_name"].strip()

    # invitation_code = hashlib.md5(
    #     guest_name.upper().encode()
    # ).hexdigest()[:10].upper()

    invitation_code = row['app']+"/"+row['invitation_token']

    filename = f"guest_{guest_id}.png"

    output_file = os.path.join(
        OUTPUT_FOLDER,
        filename
    )

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

    card = Image.open(TEMPLATE).convert("RGB")

    draw = ImageDraw.Draw(card)

    available_width = NAME_LINE_END_X - NAME_LINE_START_X

    font_size = 34

    while font_size >= 18:

        font = ImageFont.truetype(
            FONT_PATH,
            font_size
        )

        bbox = draw.textbbox(
            (0,0),
            guest_name,
            font=font
        )

        text_width = bbox[2]-bbox[0]

        if text_width <= available_width:
            break

        font_size -= 1

    name_x = NAME_LINE_START_X + (
        (available_width-text_width)//2
    )

    draw.text(
        (name_x, NAME_Y),
        guest_name,
        fill=(90,60,20),
        font=font
    )

    card.paste(
        qr_img,
        (QR_X,QR_Y)
    )

    card.save(output_file)

    generated.append({

        "id": guest_id,

        "guest_name": guest_name,

        "image": "cards/"+filename,

        "invitation_code": invitation_code

    })

print(json.dumps(generated))
