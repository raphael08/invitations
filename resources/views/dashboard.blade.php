<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$event->groom_name}} &amp; {{$event->bride_name}} · Invitation Suite</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>

    <!-- Vanilla DataTables Core -->
    <link href="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet"
        type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.js"
        type="text/javascript"></script>

    <style>
        :root {
            --cream: #FAF6EE;
            --card: #FFFFFF;
            --champagne: #F1E3C6;
            --champagne-deep: #E4CFA0;
            --gold: #B4863A;
            --gold-light: #D9B978;
            --charcoal: #2A2521;
            --charcoal-soft: #6B6258;
            --muted: #A8A196;
            --line: #EFE7D4;
            --line-soft: #F3ECDA;
            --green: #3E7A45;
            --green-bg: #E6F0E4;
            --red: #B24B34;
            --red-bg: #F6E4E0;
            --grey-bg: #EFEBE4;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: var(--charcoal);
            -webkit-font-smoothing: antialiased;
        }

        h1,
        h2,
        .serif {
            font-family: 'Playfair Display', serif;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: inherit;
            cursor: pointer;
        }

        input {
            font-family: inherit;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        /* ---------- Sidebar ---------- */
        .sidebar {
            width: 240px;
            flex-shrink: 0;
            height: 100vh;
            position: sticky;
            top: 0;
            background: #FCFAF5;
            border-right: 1px solid var(--line);
            display: flex;
            flex-direction: column;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 28px 24px 22px;
        }

        .seal {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            flex-shrink: 0;
            background: radial-gradient(circle at 32% 28%, var(--gold-light), var(--gold) 65%, #8a6526 100%);
            box-shadow: 0 3px 10px rgba(180, 134, 58, .45), inset 0 1px 1px rgba(255, 255, 255, .5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
        }

        .brand-name {
            font-size: 16px;
            line-height: 1.2;
        }

        .brand-sub {
            font-size: 11px;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: 2px;
        }

        .divider {
            height: 1px;
            background: var(--line);
            margin: 0 24px;
        }

        .nav {
            flex: 1;
            padding: 18px 16px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            color: var(--charcoal-soft);
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            transition: all .18s ease;
            position: relative;
        }

        .nav-item i {
            width: 17px;
            font-size: 14px;
        }

        .nav-item:hover {
            background: #F7F1E1;
        }

        .nav-item.active {
            background: linear-gradient(135deg, #F5EAD3, #F1E3C6);
            color: #7A5C28;
            font-weight: 600;
        }

        .nav-item.active::after {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--gold);
            position: absolute;
            right: 12px;
        }

        .sidebar-foot {
            padding: 16px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 8px;
            border-radius: 12px;
            cursor: pointer;
            transition: background .18s ease;
        }

        .profile:hover {
            background: rgba(245, 234, 211, .5);
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #fff;
            font-size: 13px;
            font-weight: 600;
        }

        .profile-name {
            font-size: 13px;
            font-weight: 500;
        }

        .profile-role {
            font-size: 11px;
            color: var(--muted);
        }

        /* ---------- Topbar ---------- */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 30;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 32px;
            background: rgba(250, 246, 238, .85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--line);
            gap: 16px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .menu-toggle {
            display: none;
            width: 36px;
            height: 36px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid var(--line);
            align-items: center;
            justify-content: center;
            color: var(--charcoal-soft);
        }

        .breadcrumb {
            font-size: 13px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .breadcrumb .current {
            color: var(--charcoal);
            font-weight: 500;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 9px 14px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid var(--line);
            width: 200px;
        }

        .search-box input {
            border: none;
            outline: none;
            background: transparent;
            font-size: 13px;
            width: 100%;
            color: var(--charcoal);
        }

        .icon-btn {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .icon-btn .dot {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--gold);
        }

        /* ---------- Mobile Sidebar Backdrop ---------- */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 55;
            background: rgba(42, 37, 33, .3);
            backdrop-filter: blur(2px);
        }

        .sidebar-backdrop.active {
            display: block;
        }

        /* ---------- Content ---------- */
        .content {
            flex: 1;
            min-width: 0;
        }

        .page {
            padding: 32px;
            display: none;
            animation: fadein .3s ease;
        }

        .page.active {
            display: block;
        }

        @keyframes fadein {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .eyebrow {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 6px;
        }

        .page-title {
            font-size: 26px;
            line-height: 1;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            border: none;
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .btn:active {
            transform: scale(.97);
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #fff;
            box-shadow: 0 4px 14px rgba(180, 134, 58, .35);
        }

        .btn-outline {
            background: #fff;
            color: var(--charcoal);
            border: 1px solid var(--line);
        }

        .btn-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .card {
            background: rgba(255, 255, 255, .9);
            border: 1px solid var(--line);
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(42, 37, 33, .04), 0 10px 30px -14px rgba(42, 37, 33, .10);
        }

        .pill {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: .02em;
            padding: 5px 10px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .pill-gold {
            background: #F5EAD3;
            color: #8a6526;
        }

        .pill-green {
            background: var(--green-bg);
            color: var(--green);
        }

        .pill-red {
            background: var(--red-bg);
            color: var(--red);
        }

        .pill-grey {
            background: var(--grey-bg);
            color: var(--charcoal-soft);
        }

        /* ---------- Dashboard stats ---------- */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .stat-card {
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: transform .25s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-glow {
            position: absolute;
            top: -32px;
            right: -32px;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--gold-light), transparent 70%);
            opacity: .4;
            filter: blur(20px);
        }

        .stat-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            position: relative;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            background: linear-gradient(135deg, #F5EAD3, #EAD9AF);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8a6526;
            font-size: 15px;
        }

        .stat-delta {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            padding: 5px 9px;
            border-radius: 999px;
        }

        .stat-delta.up {
            color: var(--green);
            background: var(--green-bg);
        }

        .stat-delta.down {
            color: var(--red);
            background: var(--red-bg);
        }

        .stat-value {
            font-size: 26px;
            margin-top: 14px;
            line-height: 1;
        }

        .stat-label {
            font-size: 12.5px;
            color: #8a8377;
            margin-top: 5px;
        }

        .stat-chart {
            height: 44px;
            margin-top: 10px;
        }

        .grid-2-1 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        .panel {
            padding: 24px;
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .panel-title {
            font-size: 15px;
            font-weight: 500;
        }

        .panel-sub {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
        }

        .sync-status-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--green);
        }

        .kv {
            display: flex;
            justify-content: space-between;
            font-size: 12.5px;
            padding: 5px 0;
        }

        .kv span:first-child {
            color: #8a8377;
        }

        /* ---------- Guests page & Table UI overrides ---------- */
        .toolbar {
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .filter-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 9px 14px;
            border-radius: 12px;
            font-size: 13px;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--charcoal-soft);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        thead tr {
            background: var(--cream);
            border-bottom: 1px solid var(--line);
        }

        th {
            text-align: left;
            font-weight: 500;
            padding: 14px 20px;
            font-size: 11px;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: #8a8377;
        }

        td {
            padding: 14px 20px;
            border-bottom: 1px solid var(--line-soft);
            color: var(--charcoal-soft);
            vertical-align: middle;
        }

        tbody tr {
            cursor: pointer;
            transition: background .15s ease;
        }

        tbody tr:hover {
            background: #FBF7EE;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .guest-name {
            font-weight: 500;
            color: var(--charcoal);
        }

        .row-actions {
            display: flex;
            gap: 6px;
        }

        .row-actions button {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            border: none;
            background: transparent;
            color: #8a8377;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .15s ease;
        }

        .row-actions button:hover {
            background: #F5EAD3;
        }

        /* ---------- Vanilla DataTables UI Refinements ---------- */
        .dataTable-wrapper .dataTable-top,
        .dataTable-wrapper .dataTable-bottom {
            padding: 16px 20px;
            font-size: 13px;
            color: var(--charcoal-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dataTable-wrapper .dataTable-top {
            border-bottom: 1px solid var(--line-soft);
        }

        .dataTable-wrapper .dataTable-bottom {
            border-top: 1px solid var(--line-soft);
        }

        /* Hide native library layouts that duplicate custom layout wrappers */
        .dataTable-search {
            display: none !important;
        }

        .dataTable-input {
            padding: 8px 14px;
            border-radius: 10px;
            border: 1px solid var(--line);
            outline: none;
            background: #fff;
            font-size: 13px;
        }

        .dataTable-selector {
            padding: 6px 10px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: #fff;
            margin-right: 6px;
            outline: none;
        }

        .dataTable-pagination ul {
            display: flex;
            list-style: none;
            gap: 4px;
        }

        .dataTable-pagination a {
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid transparent;
            transition: all 0.2s;
            color: var(--charcoal-soft);
            font-weight: 500;
        }

        .dataTable-pagination .active a {
            background: linear-gradient(135deg, var(--gold-light), var(--gold)) !important;
            color: white !important;
        }

        .dataTable-pagination a:hover:not(.active a) {
            background: var(--line-soft);
        }

        /* ---------- Drawer ---------- */
        .drawer-overlay {
            position: fixed;
            inset: 0;
            z-index: 50;
            display: none;
        }

        .drawer-overlay.open {
            display: block;
        }

        .drawer-bg {
            position: absolute;
            inset: 0;
            background: rgba(42, 37, 33, .3);
            backdrop-filter: blur(2px);
        }

        .drawer {
            position: absolute;
            right: 0;
            top: 0;
            width: 400px;
            height: 100%;
            background: #fff;
            padding: 28px;
            overflow-y: auto;
            box-shadow: -20px 0 50px -20px rgba(42, 37, 33, .3);
            animation: slidein .3s ease;
        }

        @keyframes slidein {
            from {
                transform: translateX(24px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .drawer-close {
            position: absolute;
            top: 24px;
            right: 24px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--cream);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--charcoal-soft);
        }

        .drawer-avatar {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .drawer-name {
            font-size: 22px;
        }

        .drawer-meta {
            font-size: 13px;
            color: var(--muted);
            margin-top: 4px;
        }

        .pill-row {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .qr-box {
            margin-top: 24px;
            padding: 16px;
            border-radius: 16px;
            background: var(--cream);
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .qr-square {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            color: var(--charcoal);
            flex-shrink: 0;
        }

        .qr-label {
            font-size: 12px;
            color: #8a8377;
        }

        .qr-link {
            font-size: 12.5px;
            font-weight: 500;
            margin-top: 3px;
            color: var(--charcoal);
            word-break: break-all;
        }

        .copy-link {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11.5px;
            font-weight: 500;
            color: var(--gold);
            background: none;
            border: none;
            margin-top: 8px;
            padding: 0;
        }

        .timeline {
            margin-top: 24px;
        }

        .timeline-title {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing biographical.06em;
            color: var(--muted);
            margin-bottom: 14px;
        }

        .tl-item {
            display: flex;
            gap: 12px;
            padding-bottom: 16px;
        }

        .tl-item:last-child {
            padding-bottom: 0;
        }

        .tl-dotcol {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .tl-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--gold);
            margin-top: 6px;
        }

        .tl-line {
            width: 1px;
            flex: 1;
            background: var(--line);
            margin-top: 4px;
        }

        .tl-text {
            font-size: 13px;
            color: var(--charcoal);
        }

        .tl-date {
            font-size: 11.5px;
            color: var(--muted);
            margin-top: 2px;
        }

        .drawer-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 24px;
        }

        .drawer-actions .btn {
            justify-content: center;
            width: 100%;
        }

        /* ---------- Sync page ---------- */
        .sync-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .sync-title-row {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .sync-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 14px;
            border-radius: 999px;
            background: var(--green-bg);
            color: var(--green);
            font-size: 12.5px;
            font-weight: 500;
        }

        .sync-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin: 24px 0;
        }

        .sync-stat {
            padding: 16px;
            border-radius: 16px;
            background: var(--cream);
            border: 1px solid var(--line);
        }

        .sync-stat-label {
            font-size: 11.5px;
            color: var(--muted);
        }

        .sync-stat-value {
            font-size: 19px;
            margin-top: 4px;
        }

        .history-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid var(--line-soft);
        }

        .history-row:last-child {
            border-bottom: none;
        }

        .history-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .history-time {
            width: 150px;
            font-size: 13px;
            color: var(--charcoal);
            flex-shrink: 0;
        }

        .history-pills {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* ---------- Invitations ---------- */
        .template-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .template-card {
            overflow: hidden;
            transition: transform .25s ease;
        }

        .template-card:hover {
            transform: translateY(-4px);
        }

        .template-cover {
            height: 150px;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: 14px;
        }

        .template-cover i {
            position: absolute;
            top: 14px;
            right: 14px;
            opacity: .4;
            color: #fff;
            font-size: 16px;
        }

        .template-cover-name {
            color: #fff;
            font-size: 13.5px;
        }

        .template-body {
            padding: 16px;
        }

        .template-meta {
            display: flex;
            justify-content: space-between;
            font-size: 11.5px;
            color: var(--muted);
        }

        .template-btns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 14px;
        }

        .tpl-btn {
            font-size: 12px;
            font-weight: 500;
            padding: 8px 0;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--charcoal-soft);
        }

        .tpl-btn.activate {
            background: var(--gold);
            color: #fff;
            border: none;
        }

        /* ---------- RSVP ---------- */
        .rsvp-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .rsvp-card {
            padding: 20px;
        }

        .rsvp-value {
            font-size: 24px;
            margin-top: 6px;
        }

        .rsvp-bar {
            height: 6px;
            border-radius: 999px;
            background: #F1E9D6;
            margin-top: 12px;
            overflow: hidden;
        }

        .rsvp-bar-fill {
            height: 100%;
            border-radius: 999px;
        }

        .rsvp-charts {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* ---------- Analytics ---------- */
        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .mini-card {
            padding: 20px;
        }

        .mini-title {
            font-size: 12px;
            color: var(--muted);
        }

        .mini-value {
            font-size: 20px;
            margin-top: 5px;
        }

        .mini-chart {
            height: 44px;
            margin-top: 8px;
        }

        /* ---------- Settings ---------- */
        .settings-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .settings-group {
            padding: 24px;
        }

        .settings-group-title {
            font-size: 14.5px;
            font-weight: 500;
            margin-bottom: 16px;
        }

        .field {
            margin-bottom: 14px;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        .field-label {
            font-size: 12px;
            color: #8a8377;
            margin-bottom: 6px;
        }

        .field input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 13px;
            outline: none;
            background: var(--cream);
            border: 1px solid var(--line);
            color: var(--charcoal);
        }

        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 6px 0;
        }

        .toggle-label {
            font-size: 13px;
        }

        .switch {
            width: 38px;
            height: 22px;
            border-radius: 999px;
            padding: 2px;
            display: flex;
            cursor: pointer;
            transition: background .2s;
        }

        .switch.on {
            background: var(--gold);
            justify-content: flex-end;
        }

        .switch.off {
            - background: #E9DFC8;
            justify-content: flex-start;
        }

        .switch-knob {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #fff;
        }

        .swatches {
            display: flex;
            gap: 8px;
        }

        .swatch {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 1px var(--line);
        }

        /* ---------- Empty state ---------- */
        .empty-state {
            padding: 70px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .empty-icon {
            color: var(--gold);
            font-size: 26px;
            margin-bottom: 14px;
        }

        .empty-title {
            font-size: 15px;
            font-weight: 500;
        }

        .empty-sub {
            font-size: 13px;
            color: var(--muted);
            margin-top: 4px;
        }

        /* ---------- Toast ---------- */
        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 80;
            display: none;
            gap: 12px;
            align-items: center;
            padding: 14px 18px;
            border-radius: 16px;
            background: #fff;
            border: 1px solid var(--line);
            box-shadow: 0 12px 32px -8px rgba(42, 37, 33, .25);
            animation: fadein .25s ease;
        }

        .toast.show {
            display: flex;
        }

        .toast-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #F5EAD3;
            color: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .toast-title {
            font-size: 13px;
            font-weight: 500;
        }

        .toast-body {
            font-size: 12px;
            color: var(--muted);
        }

        @media (max-width:1000px) {

            .stat-grid,
            .grid-2-1,
            .settings-grid,
            .template-grid,
            .analytics-grid,
            .rsvp-grid,
            .rsvp-charts {
                grid-template-columns: 1fr 1fr;
            }

            .sidebar {
                position: fixed;
                z-index: 60;
                transform: translateX(-100%);
                transition: transform .25s ease;
                box-shadow: 20px 0 40px rgba(0, 0, 0, 0.1);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .menu-toggle {
                display: flex;
            }

            .topbar {
                padding: 16px 20px;
            }

            .page {
                padding: 20px;
            }

            .drawer {
                width: 100%;
                max-width: 400px;
            }
        }

        @media (max-width:600px) {

            .stat-grid,
            .grid-2-1,
            .settings-grid,
            .template-grid,
            .analytics-grid,
            .rsvp-grid,
            .rsvp-charts {
                grid-template-columns: 1fr;
            }

            .topbar-right .search-box {
                display: none;
            }
        }

        /* Responsive Table Wrapping & Scrolling */
        .table-responsive,
        .dataTable-container {
            width: 100%;
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch;
        }

        /* Ensure tables do not squeeze or cut off content */
        table,
        .dataTable-table {
            width: 100% !important;
            white-space: nowrap;
            /* Keeps content on a single line so columns expand naturally */
        }

        /* Optional: Fix padding and allow longer text (like messages) to wrap if needed */
        td,
        th {
            white-space: nowrap;
        }

        td.guest-name,
        td:nth-child(3) {
            /* Allows text in specific columns to wrap gracefully if necessary */
            white-space: normal;
            min-width: 140px;
        }

        @media (max-width:600px) {
            /* Existing rules... */

            .dataTable-wrapper .dataTable-top,
            .dataTable-wrapper .dataTable-bottom {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .dataTable-wrapper .dataTable-search,
            .dataTable-wrapper .dataTable-dropdown {
                width: 100%;
            }

            .dataTable-input {
                width: 100%;
            }
        }

        .btn-whatsapp {
            background: #25D366;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: 13px;
            transition: all .2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-whatsapp:hover {
            background: #20BA5F;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        }

        .btn-whatsapp:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .btn-whatsapp-all {
            background: #128C7E;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: 13px;
            transition: all .2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-whatsapp-all:hover {
            background: #0f6b63;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(18, 140, 126, 0.3);
        }
    </style>
</head>

<body>

    <div class="app">
        <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleMobileSidebar()"></div>

        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="brand">
                <div class="seal"><i class="fa-solid fa-sparkles"></i></div>
                <div>
                    <div class="brand-name serif">{{$event->groom_name}} &amp; {{$event->bride_name}}</div>
                    <div class="brand-sub">Invitation Suite</div>
                </div>
            </div>
            <div class="divider"></div>
            <nav class="nav" id="nav">
                <button class="nav-item active" data-page="dashboard"><i
                        class="fa-solid fa-grid-2"></i><span>Dashboard</span></button>
                <button class="nav-item" data-page="guests"><i
                        class="fa-solid fa-users"></i><span>Guests</span></button>
                {{-- <button class="nav-item" data-page="sync"><i class="fa-solid fa-arrows-rotate"></i><span>Google Sheet
                        Sync</span></button> --}}
                {{-- <button class="nav-item" data-page="invitations"><i
                        class="fa-solid fa-envelope-open-text"></i><span>Invitations</span></button> --}}
                <button class="nav-item" data-page="rsvp"><i class="fa-solid fa-clipboard-check"></i><span>RSVP
                        Responses</span></button>
                {{-- <button class="nav-item" data-page="messages"><i
                        class="fa-solid fa-message"></i><span>Messages</span></button>
                <button class="nav-item" data-page="analytics"><i
                        class="fa-solid fa-chart-simple"></i><span>Analytics</span></button> --}}
                <button class="nav-item" data-page="settings"><i
                        class="fa-solid fa-gear"></i><span>Settings</span></button>
            </nav>
            <div class="divider"></div>
            <div class="sidebar-foot">
                <div class="profile">
                    <div class="avatar">NR</div>
                    <div style="flex:1; min-width:0;">
                        <div class="profile-name">Raphael Mkilya</div>
                        <div class="profile-role">Administrator</div>
                    </div>
                    <i class="fa-solid fa-arrow-right-from-bracket" style="color:var(--muted); font-size:14px;"></i>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="content">
            <div class="topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" onclick="toggleMobileSidebar()"><i
                            class="fa-solid fa-bars"></i></button>
                    <div class="breadcrumb"><span>Wedding Suite</span><i class="fa-solid fa-chevron-right"
                            style="font-size:10px;"></i><span class="current" id="crumb">Dashboard</span></div>
                </div>
                <div class="topbar-right">
                    <div class="search-box"><i class="fa-solid fa-magnifying-glass"
                            style="color:var(--muted); font-size:13px;"></i><input id="globalSearch" placeholder="Search anything…" oninput="globalSearch(this.value)" />
                    </div>
                    <button class="icon-btn"><i class="fa-regular fa-bell" style="color:var(--charcoal-soft);"></i><span
                            class="dot"></span></button>
                </div>
            </div>

            <!-- ============ DASHBOARD ============ -->
            <section class="page active" id="page-dashboard">
                <div class="page-head">
                    <div>
                        <div class="eyebrow">Overview</div>
                        <h1 class="page-title">Good afternoon, Nadia</h1>
                    </div>
                    <button class="btn btn-gold"
                        onclick="notify('Guest added','The new guest was saved to your list.')"><i
                            class="fa-solid fa-plus"></i>Add Guest</button>
                </div>

                <div class="stat-grid" id="statGrid"></div>

                <div class="grid-2-1">
                    <div class="card panel">
                        <div class="panel-head">
                            <div>
                                <div class="panel-title">RSVP Momentum</div>
                                <div class="panel-sub">Responses collected over the last 10 days</div>
                            </div>
                            <span class="pill pill-gold">Live</span>
                        </div>
                        <canvas id="rsvpMomentum" height="90"></canvas>
                    </div>

                    <div class="card panel">
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:2px;">
                            <i class="fa-solid fa-arrows-rotate" style="color:var(--gold); font-size:14px;"></i>
                            <div class="panel-title">Sheet Sync</div>
                        </div>
                        <div class="panel-sub" style="margin-bottom:16px;">Wedding Guest List · Guests tab</div>
                        <div class="sync-status-row"><span class="status-dot"></span><span
                                style="font-size:13px; font-weight:500;">Connected</span></div>
                        <div class="kv"><span>Rows in sheet</span><span style="color:var(--charcoal);"
                                class="sh"></span></div>
                        <div class="kv"><span>Rows in database</span><span style="color:var(--charcoal);"
                                class="db">{{ $stats['totalGuests'] }}</span></div>
                        <div class="kv"><span>Last sync</span><span style="color:var(--charcoal);"
                                class="last">Today, 10:45 AM</span></div>
                        <button class="btn btn-gold" style="width:100%; justify-content:center; margin-top:16px;"
                            onclick="fetchGuestsFromPublishedSheet()"><i class="fa-solid fa-arrows-rotate"></i>Sync
                            Now</button>
                    </div>
                </div>
            </section>

            <!-- ============ GUESTS ============ -->
            <section class="page" id="page-guests">
                <div class="page-head">
                    <div>
                        <div class="eyebrow">Guest List</div>
                        <h1 class="page-title" class="class">{{ $stats['totalGuests'] }} guests, one beautiful day
                        </h1>
                    </div>
                    <div class="btn-row">
                        <button class="btn btn-outline"><i class="fa-solid fa-download"></i>Export Excel</button>
                        <button class="btn btn-outline" id="bulk-generate-btn"
                            onclick="processBulkCardGenerationPipeline()"><i class="fa-solid fa-images"></i>Generate
                            Cards</button>
                        <button class="btn btn-danger" id="bulk-generate-btn"
                            onclick="processBulkDeletePipeline()" style="background-color: red"><i class="fa-solid fa-trash"></i>Delete
                            Cards</button>
                        <button class="btn btn-danger" id="bulk-generate-btn"
                            onclick="processBulkdownloadCardsPipeline()" style="background-color: cyan"><i class="fa-solid fa-download"></i>Download
                            Cards</button>
                        <button class="btn btn-gold"><i class="fa-solid fa-plus"></i>Add Guest</button>
                        <!-- Option A: Send to Selected Guests (uses checkboxes) -->
                        {{-- <button id="bulk-whatsapp-btn" onclick="sendBulkWhatsAppInvitations(false)"
                            class="btn btn-whatsapp">
                            <i class="fa-brands fa-whatsapp"></i> Send WhatsApp to Selected
                        </button>

                        <!-- Option B: Send to All Guests (no checkbox needed) -->
                        <button onclick="sendBulkWhatsAppInvitations(true)" class="btn btn-whatsapp-all">
                            <i class="fa-brands fa-whatsapp"></i> Send to All Guests
                        </button> --}}
                    </div>
                </div>

                <div class="card toolbar">
                    <div class="search-box" style="flex:1; min-width:220px;">
                        <i class="fa-solid fa-magnifying-glass" style="color:var(--muted); font-size:13px;"></i>
                        <input id="guestSearch" placeholder="Search guests by name…" oninput="filterGuests()" />
                    </div>
                    <button class="filter-btn"><i class="fa-solid fa-filter"></i>Side</button>
                    <button class="filter-btn"><i class="fa-solid fa-filter"></i>RSVP</button>
                    <button class="filter-btn"><i class="fa-solid fa-filter"></i>Invitation Status</button>
                </div>

                <div class="card" style="overflow:hidden;">
                    <div class="table-responsive">
                        <table id="guestsTable">
                            <thead>
                                <tr>
                                    <th data-sortable="false" style="width: 40px;">
                                    {{-- <input type="checkbox" id="selectAllGuests" onclick="toggleSelectAllGuests(this)"> --}}
                                    <input type="checkbox" id="selectAllGuests" onclick="toggleSelectAllGuests(this)">
                                    </th>
                                    <th>Guest ID</th>
                                    <th>Guest Name</th>
                                    <th>Phone Number</th>
                                    {{-- <th>Side</th> --}}
                                    <th>Invitation</th>
                                    <th>RSVP</th>
                                    <th>Date Invited</th>
                                    <th data-sortable="false">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="guestTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- ============ GOOGLE SHEET SYNC ============ -->
            <section class="page" id="page-sync">
                <div class="page-head">
                    <div>
                        <div class="eyebrow">Integrations</div>
                        <h1 class="page-title">Google Sheet Synchronization</h1>
                    </div>
                </div>

                <div class="card panel" style="margin-bottom:24px;">
                    <div class="sync-head">
                        <div class="sync-title-row">
                            <div class="stat-icon"
                                style="width:48px; height:48px; border-radius:16px; font-size:19px;"><i
                                    class="fa-solid fa-arrows-rotate"></i></div>
                            <div>
                                <div class="panel-title">Wedding Guest List</div>
                                <div class="panel-sub">Worksheet · Guests</div>
                            </div>
                        </div>
                        <div class="sync-badge"><span class="status-dot"></span>Connected</div>
                    </div>

                    <div class="sync-stats">
                        <div class="sync-stat">
                            <div class="sync-stat-label">Rows in Google Sheet</div>
                            <div class="sync-stat-value serif">520</div>
                        </div>
                        <div class="sync-stat">
                            <div class="sync-stat-label">Rows in Database</div>
                            <div class="sync-stat-value serif">520</div>
                        </div>
                        <div class="sync-stat">
                            <div class="sync-stat-label">Last Sync</div>
                            <div class="sync-stat-value serif">Today, 10:45 AM</div>
                        </div>
                    </div>

                    <div class="btn-row">
                        <button class="btn btn-gold" onclick="fetchGuestsFromPublishedSheet()"><i
                                class="fa-solid fa-arrows-rotate"></i>Sync Now</button>
                        <button class="btn btn-outline"><i class="fa-solid fa-arrow-up-right-from-square"></i>Open
                            Google Sheet</button>
                        <button class="btn btn-outline"><i class="fa-solid fa-rotate-right"></i>Refresh</button>
                    </div>
                </div>

                <div class="card panel">
                    <div class="panel-title" style="margin-bottom:6px;">Synchronization History</div>
                    <div id="syncHistory"></div>
                </div>
            </section>

            <!-- ============ INVITATIONS ============ -->
            <section class="page" id="page-invitations">
                <div class="page-head">
                    <div>
                        <div class="eyebrow">Templates</div>
                        <h1 class="page-title">Invitation Designs</h1>
                    </div>
                    <button class="btn btn-gold"><i class="fa-solid fa-plus"></i>Create New Invitation</button>
                </div>
                <div class="template-grid" id="templateGrid"></div>
            </section>

            <!-- ============ RSVP ============ -->
            <section class="page" id="page-rsvp">
                <div class="page-head">
                    <div>
                        <div class="eyebrow">Responses</div>
                        <h1 class="page-title">RSVP Dashboard</h1>
                    </div>
                </div>

                <div class="rsvp-grid" id="rsvpGrid"></div>

                {{-- <div class="rsvp-charts">
                    <div class="card panel">
                        <div class="panel-title" style="margin-bottom:16px;">Response Breakdown</div>
                        <canvas id="rsvpPie" height="200"></canvas>
                    </div>
                    <div class="card panel">
                        <div class="panel-title" style="margin-bottom:16px;">Daily RSVP Activity</div>
                        <canvas id="rsvpDaily" height="200"></canvas>
                    </div>
                </div> --}}

                <div class="card" style="overflow:hidden;">
                    <div class="panel-title" style="padding:20px 24px 4px 24px;">Recent Responses</div>
                    <table id="rsvpTable">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Guest Name</th>
                                <th>Status</th>
                                <th style="text-align:right;">Response</th>
                                <th style="text-align:right;">Response Date</th>
                            </tr>
                        </thead>
                        <tbody id="rsvpTableBody"></tbody>
                    </table>
                </div>
            </section>

            <!-- ============ MESSAGES ============ -->
            <section class="page" id="page-messages">
                <div class="page-head">
                    <div>
                        <div class="eyebrow">Inbox</div>
                        <h1 class="page-title">Messages</h1>
                    </div>
                </div>
                <div class="card empty-state">
                    <i class="fa-regular fa-message empty-icon"></i>
                    <div class="empty-title">No conversations yet</div>
                    <div class="empty-sub">Guest replies to your invitations will appear here.</div>
                </div>
            </section>

            <!-- ============ ANALYTICS ============ -->
            <section class="page" id="page-analytics">
                <div class="page-head">
                    <div>
                        <div class="eyebrow">Insights</div>
                        <h1 class="page-title">Analytics</h1>
                    </div>
                </div>
                <div class="analytics-grid" id="analyticsGrid"></div>
            </section>

            <!-- ============ SETTINGS ============ -->
            <section class="page" id="page-settings">
                <div class="page-head">
                    <div>
                        <div class="eyebrow">Configuration</div>
                        <h1 class="page-title">Settings</h1>
                    </div>
                </div>
                <div class="settings-grid">
                    <div class="card settings-group">
                        <div class="settings-group-title">Wedding Information</div>
                        <div class="field">
                            <div class="field-label">Groom Name</div><input value="{{ $event->groom_name }}" />
                        </div>
                        <div class="field">
                            <div class="field-label">Bride Name</div><input value="{{ $event->bride_name }}" />
                        </div>
                        <div class="field">
                            <div class="field-label">Wedding Date</div><input value="{{ $event->event_date }}" />
                        </div>
                        <div class="field">
                            <div class="field-label">Venue</div><input value="Serengeti Garden Estate, Mwanza" />
                        </div>
                    </div>
                    <div class="card settings-group">
                        <div class="settings-group-title">Google Sheet Integration</div>
                        <div class="field">
                            <div class="field-label">Google Spreadsheet ID</div><input
                                value="{{ $sheet->spreadsheet_id }}" />
                        </div>
                        {{-- <div class="field">
                            <div class="field-label">Worksheet Name</div><input value="{{  }}" />
                        </div> --}}
                        {{-- <div class="field">
                            <div class="field-label">Google Service Account</div><input
                                value="sync@wedsuite.iam.gserviceaccount.com" />
                        </div> --}}
                        {{-- <div class="field">
                            <div class="field-label">Sync Interval</div><input value="Every 30 minutes" />
                        </div> --}}
                    </div>
                    {{-- <div class="card settings-group">
                        <div class="settings-group-title">Notifications</div>
                        <div class="toggle-row"><span class="toggle-label">WhatsApp Integration</span>
                            <div class="switch on" onclick="toggleSwitch(this)">
                                <div class="switch-knob"></div>
                            </div>
                        </div>
                        <div class="toggle-row"><span class="toggle-label">Email Settings</span>
                            <div class="switch on" onclick="toggleSwitch(this)">
                                <div class="switch-knob"></div>
                            </div>
                        </div>
                        <div class="toggle-row"><span class="toggle-label">Enable Guest QR Code</span>
                            <div class="switch on" onclick="toggleSwitch(this)">
                                <div class="switch-knob"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card settings-group">
                        <div class="settings-group-title">Theme Customization</div>
                        <div class="toggle-row">
                            <span class="toggle-label">Accent Color</span>
                            <div class="swatches">
                                <div class="swatch" style="background:#B4863A;"></div>
                                <div class="swatch" style="background:#C97C5D;"></div>
                                <div class="swatch" style="background:#8C8377;"></div>
                                <div class="swatch" style="background:#2A2521;"></div>
                            </div>
                        </div>
                        <div class="field" style="margin-top:14px;">
                            <div class="field-label">Typography</div><input value="Playfair Display / Inter" />
                        </div>
                        <div class="toggle-row"><span class="toggle-label">Enable Countdown</span>
                            <div class="switch on" onclick="toggleSwitch(this)">
                                <div class="switch-knob"></div>
                            </div>
                        </div>
                        <div class="toggle-row"><span class="toggle-label">Enable Maps</span>
                            <div class="switch off" onclick="toggleSwitch(this)">
                                <div class="switch-knob"></div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </section>
        </div>
    </div>

    <!-- PROFILE DRAWER OVERLAY -->
    <div class="drawer-overlay" id="drawerOverlay">
        <div class="drawer-bg" onclick="closeDrawer()"></div>
        <div class="drawer">
            <button class="drawer-close" onclick="closeDrawer()"><i class="fa-solid fa-xmark"></i></button>
            <div class="drawer-avatar" id="drawerAvatar">AW</div>
            <div class="drawer-name serif" id="drawerName">{{$event->groom_name}} Whitfield</div>
            <div class="drawer-meta" id="drawerMeta">+255 712 334 210 · G-0142</div>
            <div class="pill-row" id="drawerPills"></div>

            <div class="qr-box">
                <div class="qr-square"><i class="fa-solid fa-qrcode"></i></div>
                <div style="flex:1; min-width:0;">
                    <div class="qr-label">Unique invitation link</div>
                    <div class="qr-link" id="drawerLink"></div>
                    <button class="copy-link" onclick="copyDrawerLink()"><i class="fa-solid fa-copy"></i>Copy
                        link</button>
                </div>
            </div>
            {{-- <div class="timeline">
                <div class="timeline-title">Timeline</div>
                <div class="tl-item">
                    <div class="tl-dotcol"><span class="tl-dot"></span><span class="tl-line"></span></div>
                    <div>
                        <div class="tl-text">Invitation sent via WhatsApp</div>
                        <div class="tl-date">12 Jun, 4:02 PM</div>
                    </div>
                </div>
                <div class="tl-item">
                    <div class="tl-dotcol"><span class="tl-dot"></span><span class="tl-line"></span></div>
                    <div>
                        <div class="tl-text">Invitation viewed</div>
                        <div class="tl-date">12 Jun, 6:40 PM</div>
                    </div>
                </div>
                <div class="tl-item">
                    <div class="tl-dotcol"><span class="tl-dot"></span></div>
                    <div>
                        <div class="tl-text">RSVP submitted</div>
                        <div class="tl-date">13 Jun, 9:15 AM</div>
                    </div>
                </div>
            </div> --}}

            <div class="drawer-actions">
                <button class="btn btn-gold" id="sendWhatsAppBtn"><i class="fa-solid fa-paper-plane"></i>Send
                    Whatsapp</button>
                <button class="btn btn-outline"><i class="fa-solid fa-pen"></i>Send Text</button>
                <button class="btn btn-outline" onclick="copyDrawerLink()"><i class="fa-solid fa-link"></i>Copy
                    Link</button>

                {{-- <button class="btn btn-outline" onclick="download()"><i class="fa-solid fa-download"></i>Download card</button> --}}
            </div>
        </div>
    </div>

    <!-- TOAST -->
    <div class="toast" id="toast">
        <div class="toast-icon"><i class="fa-solid fa-circle-check"></i></div>
        <div>
            <div class="toast-title" id="toastTitle">Title</div>
            <div class="toast-body" id="toastBody">Body</div>
        </div>
    </div>

    <script>
        /* ---------------- Navigation Engine ---------------- */

       const selectedGuests = new Set();
        document.querySelectorAll(".nav-item").forEach(btn => {
            btn.addEventListener("click", () => {
                document.querySelectorAll(".nav-item").forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                document.querySelectorAll(".page").forEach(p => p.classList.remove("active"));
                document.getElementById(`page-${btn.dataset.page}`).classList.add("active");
                document.getElementById("crumb").textContent = btn.querySelector("span").textContent;

                if (window.innerWidth <= 1000) {
                    toggleMobileSidebar();
                }
            });
        });



        function toggleMobileSidebar() {
            document.getElementById("sidebar").classList.toggle("open");
            document.getElementById("sidebarBackdrop").classList.toggle("active");
        }

        let url = @json($sheet);
        let sett = @json($setting);
        let app = @json($app);

        // console.log(url);

        /* ---------------- CSV Parser & Google Sheets Sync Engine ---------------- */
        const PUBLISHED_CSV_URL = url.spreadsheet_id;

        let GUESTS = [];
        let guestsDataTableInstance = null;
        let rsvpDataTableInstance = null;

        document.querySelectorAll(".guest-select-checkbox").forEach(cb => {
    cb.checked = selected.has(cb.dataset.id);
});

        async function fetchGuestsFromPublishedSheet() {
            try {
                const response = await fetch(PUBLISHED_CSV_URL, {
                    cache: "no-store"
                });
                if (!response.ok) throw new Error(`HTTP ${response.status}`);
                const csvText = await response.text();
                const rows = parseCSV(csvText);
                const dataRows = rows.slice(2);

                GUESTS = [];
                for (const row of dataRows) {
                    if (!row[1] || row[1].trim() === "") break;
                    GUESTS.push({
                        guest_code: row[0]?.trim() || "",
                        guest_name: row[1]?.trim() || "",
                        phone: row[6]?.trim() || "",
                        side: row[9]?.trim() || "Bride",
                        inv: row[9]?.trim() || "Sent",
                        rsvp: row[9]?.trim() || "Pending",
                        date: row[3]?.trim() || "—",
                        amount: row[4]?.trim() || "—",
                    });
                }


                renderGuests(GUESTS);
                loadGuestsFromDatabase();
                updateRsvpDependentUI();
                updates();
                notify("Sync Complete", `${GUESTS.length} guests synchronized live.`);
            } catch (error) {
                console.error(error);
                notify("Sync Failed", "Using local backup registry.");
                // Fallback load local array data if server fetch hits network limits
                GUESTS = LOCAL_GUEST_BACKUP;
                renderGuests(GUESTS);
                updateRsvpDependentUI();
            }
        }

        /* ---------------- Database Sync & Fetch Engine ---------------- */
        let GUEST = [];
        guestsDataTableInstance = null;
        rsvpDataTableInstance = null;

        // Directly feed the database array from your Laravel controller into JavaScript
        const DATABASE_GUESTS = @json($guests ?? []);

        // console.log(DATABASE_GUESTS);


        function loadGuestsFromDatabase() {
            try {
                // console.log('here');

                // Fall back to your local backup array if the database table collection is currently empty
                if (!DATABASE_GUESTS || DATABASE_GUESTS.length === 0) {
                    console.warn("Database registry is empty. Loading local backup...");
                    GUEST = LOCAL_GUEST_BACKUP;
                } else {
                    GUEST = DATABASE_GUESTS.map(g => ({
                    // console.log(g);
                        // Map database column names safely to your UI keys
                        guest_code: g.guest_code || g.id || "",
                        guest_name: g.guest_name || g.name || "",
                        phone: g.phone || "—",
                        side: g.side || "-",
                        inv: g.inv || g.invitation_status || "Sent",
                        rsvp: g.rsvp || g.rsvp_status || "Pending",
                        date: g.date || g.invited_at || "—",
                        inv_code: g.invitation_token || "—"
                    }));
                }

                renderGuests(GUEST);
                updateRsvpDependentUI();

                // Dynamically update rows count display
                if (document.querySelector('.sh')) {
                    document.querySelector('.sh').textContent = GUESTS.length;
                }
            } catch (error) {
                console.error("Failed to parse database records:", error);
                notify("Error", "Could not load guest list from database.");
            }
        }

        function updates() {
            // GUESTS = [];
            // console.log('this');

            document.querySelector('.sh').textContent = GUESTS.length;
            // console.log(GUESTS.length);


            // if (GUESTS.length != stats.totalGuests) {
            if (1) {

                fetch('/' + stats.app + '/sync_guest', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            guests: GUESTS
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // console.log(data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }


        }


        function parseCSV(text) {
            const rows = [];
            const lines = text.trim().split(/\r?\n/);
            for (const line of lines) {
                const row = [];
                let current = "";
                let inQuotes = false;
                for (let i = 0; i < line.length; i++) {
                    const char = line[i];
                    if (char === '"') inQuotes = !inQuotes;
                    else if (char === "," && !inQuotes) {
                        row.push(current);
                        current = "";
                    } else current += char;
                }
                row.push(current);
                rows.push(row.map(cell => cell.trim().replace(/^"|"$/g, "")));
            }
            return rows;
        }

        /* ---------------- Render Tables & Bind DataTables ---------------- */
        // function renderGuests(list){
        //   const body = document.getElementById("guestTableBody");
        //   if(!body) return;

        //   if (guestsDataTableInstance) {
        //     guestsDataTableInstance.destroy();
        //   }

        //   body.innerHTML = list.map(g => `
    //     <tr onclick="openDrawer('${g.guest_code}')">
    //       <td style="color:var(--muted); font-weight:600;">${g.guest_code}</td>
    //       <td class="guest-name">${g.guest_name}</td>
    //       <td>${g.phone}</td>
    //       <td>${pill(g.side, g.side==="Bride" ? "gold":"grey")}</td>
    //       <td>${pill(g.inv, g.inv==="Sent" ? "green":"grey")}</td>
    //       <td>${pill(g.rsvp, rsvpTone(g.rsvp))}</td>
    //       <td>${g.date}</td>
    //       <td onclick="event.stopPropagation()">
    //         <div class="row-actions">
    //           <button onclick="openDrawer('${g.guest_code}')"><i class="fa-regular fa-eye"></i></button>
    //           <button><i class="fa-solid fa-pen"></i></button>
    //           <button><i class="fa-solid fa-paper-plane"></i></button>
    //         </div>
    //       </td>
    //     </tr>
    //   `).join("");

        //   guestsDataTableInstance = new DataTable("#guestsTable", {
        //     perPage: 10,
        //     perPageSelect: [5, 10, 25, 50],
        //     nextPrev: true,
        //     firstLast: false
        //   });
        // }

        function renderGuests(list) {



            const body = document.getElementById("guestTableBody");
            let base_url = @json($url);
            if (!body) return;

            if (guestsDataTableInstance) {
                guestsDataTableInstance.destroy();
            }

            body.innerHTML = list.map(g => {
                const code = g.id || g.guest_code || "";
                const name = g.guest_name || g.name || "";
                const urls = base_url + code + '.png'
                const rsvp = g.rsvp;

                let display = 'block';

                if (g.rsvp !== "Accepted") {
                    display = "none";
                }
                if(g.side == 'S' || g.side == 'D'){
                    g.side = 'Completed';
                }else{
                    g.side = 'Incomplete';
                }
                // console.log(g.side);


                // console.log(g.guest_code);



                return `
      <tr onclick="openDrawer('${code}')">
        <!-- Stop propagation avoids opening the side panel drawer when checking the checkbox box -->
        <td onclick="event.stopPropagation()">
          <input type="checkbox"
       class="guest-select-checkbox"
       data-code="${code}"
       onchange="toggleGuest(this)">
        </td>
        <td style="color:var(--muted); font-weight:600;">${code}</td>
        <td class="guest-name">${name}</td>
        <td>${g.phone}</td>

        <td>${pill(g.side, g.side==="Completed" ? "green":"grey")}</td>
        <td>${pill(g.rsvp, g.rsvp==="Accepted" ? "green":"grey")}</td>
        <td>${g.date}</td>
        <td onclick="event.stopPropagation()">
          <div class="row-actions">
            <button onclick="openDrawer('${code}')"><i class="fa-regular fa-eye"></i></button>
            <button onclick="openDrawer('${code}')"><i class="fa-solid fa-pen"></i></button>
            <button><i class="fa-solid fa-paper-plane"></i></button>
<button>
            <a href="${urls}"
   download="Abel_Anlin_Wedding_Ticket.png"
   style="display:${display}; text-decoration:none; "
   class="">
    <i class="fa-solid fa-download" style="margin-right: 5px;"></i>

</a>
</button>
          </div>
        </td>
      </tr>
    `;
            }).join("");

            // No DataTable for the guests list (no pagination wanted).
            // Searching is done by filterGuests() directly on the table rows.
            guestsDataTableInstance = null;

            // Re-apply any text already typed in the search box after a re-render
            filterGuests();
        }

        // function updateRsvpDependentUI() {
        //   const rsvpTable = document.getElementById("rsvpTableBody");
        //   if (!rsvpTable) return;

        //   if (rsvpDataTableInstance) {
        //     rsvpDataTableInstance.destroy();
        //   }

        //   const responses = GUESTS.filter(g => g.rsvp !== "—" && g.rsvp !== "");
        //   rsvpTable.innerHTML = responses.map(g => `
    //     <tr>
    //       <td class="guest-name">${g.name}</td>
    //       <td>${g.side}'s side</td>
    //       <td>${pill(g.rsvp, rsvpTone(g.rsvp))}</td>
    //       <td style="text-align:right; color:var(--muted);">${g.date}</td>
    //     </tr>
    //   `).join("");

        //   rsvpDataTableInstance = new DataTable("#rsvpTable", {
        //     perPage: 5,
        //     perPageSelect: [5, 10, 20],
        //     nextPrev: true
        //   });
        // }
        // Calculate RSVP counts from actual guest data
        function calculateRsvpCounts() {
            const allGuests = GUEST && GUEST.length > 0 ? GUEST : GUESTS;

            // Count responses
            let accepted = 0,
                declined = 0,
                pending = 0,
                maybe = 0;

            allGuests.forEach(g => {
                const rsvp = (g.rsvp || "").toLowerCase().trim();
                if (rsvp === "accepted" || rsvp === "yes") {
                    accepted++;
                } else if (rsvp === "declined" || rsvp === "no") {
                    declined++;
                } else if (rsvp === "maybe") {
                    maybe++;
                } else if (rsvp === "pending" || rsvp === "—" || rsvp === "" || rsvp === "-") {
                    pending++;
                } else if (rsvp) { // Any other response defaults to pending
                    pending++;
                }
            });

            // Update RSVP_SUMMARY with actual counts
            RSVP_SUMMARY[0].value = accepted;
            RSVP_SUMMARY[1].value = declined;
            RSVP_SUMMARY[2].value = pending;
            RSVP_SUMMARY[3].value = maybe;

            return {
                accepted,
                declined,
                pending,
                maybe
            };
        }

        // Update RSVP cards and charts with new counts
        function refreshRsvpDisplayCards() {
            const rsvpGrid = document.getElementById("rsvpGrid");
            if (rsvpGrid) {
                rsvpGrid.innerHTML = RSVP_SUMMARY.map(r => `
    <div class="card rsvp-card">
      <div class="mini-title">${r.name}</div>
      <div class="rsvp-value serif">${r.value}</div>
      <div class="rsvp-bar"><div class="rsvp-bar-fill" style="width:${(r.value/Math.max(1, RSVP_SUMMARY.reduce((a,b)=>a+b.value,0)))*100}%; background:${r.color};"></div></div>
    </div>
  `).join("");
            }

            // Update pie chart if it exists
            if (typeof Chart !== 'undefined' && window.rsvpPieChart) {
                window.rsvpPieChart.data.labels = RSVP_SUMMARY.map(r => r.name);
                window.rsvpPieChart.data.datasets[0].data = RSVP_SUMMARY.map(r => r.value);
                window.rsvpPieChart.data.datasets[0].backgroundColor = RSVP_SUMMARY.map(r => r.color);
                window.rsvpPieChart.update();
            }
        }


        // console.log(response);

        function updateRsvpDependentUI() {
            const rsvpTable = document.getElementById("rsvpTableBody");
            if (!rsvpTable) return;

            if (rsvpDataTableInstance) {
                rsvpDataTableInstance.destroy();
            }

            // Use GUEST (database) if available, otherwise use GUESTS (CSV)
            const allGuests = response && response.length > 0 ? response : response;

            // Filter and sort - show responded guests first (most recent), then pending
            const responded = allGuests.filter(g => g.rsvp && g.rsvp !== "—" && g.rsvp.toLowerCase() !== "pending" && g
                .rsvp !== "");
            const pending = allGuests.filter(g => !g.rsvp || g.rsvp === "—" || g.rsvp.toLowerCase() === "pending" || g
                .rsvp === "");

            const responses = [...responded, ...pending].slice(0, 100); // Show top 100

            let color = "green";


            rsvpTable.innerHTML = responses.map((g, index) => {
                // Check if attendance is NOT 'Accepted'
                const isNotAccepted = g.attendance !== 'Accepted';
                const textColor = isNotAccepted ? 'red' : 'inherit';

                // Format date and time (e.g., "Jul 24, 2026, 12:27 PM")
                let formattedDateTime = '—';
                if (g.updated_at) {
                    const dateObj = new Date(g.updated_at);
                    if (!isNaN(dateObj)) {
                        formattedDateTime = dateObj.toLocaleString('en-US', {
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: '2-digit',
                            hour12: true
                        });
                    }
                }

                return `
    <tr>
      <td style="font-weight: 600; color: var(--muted);">${index + 1}</td>
      <td class="guest-name">${g.guest?.guest_name || g.name || 'Unknown'}</td>
      <td style="color: ${textColor}" class="pill-${color}">${pill(g.rsvp || '—', rsvpTone(g.rsvp || ''))}</td>
      <td>${g.message || '-'}</td>
      <td style="text-align:right; color:var(--muted);">${formattedDateTime}</td>
    </tr>
  `;
            }).join("");

            rsvpDataTableInstance = new DataTable("#rsvpTable", {
                perPage: 10,
                perPageSelect: [5, 8, 10, 20],
                nextPrev: true,
                searchable: true // Enables the search input box
            });

            // Calculate and update counts
            calculateRsvpCounts();
            refreshRsvpDisplayCards();
        }

        const stats = @json($stats);
        let response = @json($resp ?? []);
        // console.log(response);


        function filterGuests() {
            const input = document.getElementById("guestSearch");
            const body = document.getElementById("guestTableBody");
            if (!input || !body) return;

            const q = input.value.trim().toLowerCase();
            let visible = 0;

            body.querySelectorAll("tr:not(.no-results-row)").forEach(tr => {
                const match = !q || tr.textContent.toLowerCase().includes(q);
                tr.style.display = match ? "" : "none";
                if (match) visible++;
            });

            // "No results" row
            let empty = body.querySelector(".no-results-row");
            if (visible === 0 && q) {
                if (!empty) {
                    empty = document.createElement("tr");
                    empty.className = "no-results-row";
                    empty.innerHTML = '<td colspan="8" style="text-align:center; padding:24px; color:var(--muted);">No guests match your search.</td>';
                    body.appendChild(empty);
                }
            } else if (empty) {
                empty.remove();
            }
        }

        // Topbar "Search anything…" box: jumps to the Guests page and searches there
        function globalSearch(val) {
            val = val.trim();
            const guestInput = document.getElementById("guestSearch");
            if (!guestInput) return;
            guestInput.value = val;
            if (val) {
                const guestsPage = document.getElementById("page-guests");
                if (guestsPage && !guestsPage.classList.contains("active")) {
                    const navBtn = document.querySelector('.nav-item[data-page="guests"]');
                    if (navBtn) navBtn.click();
                }
            }
            filterGuests();
        }

        /* ---------------- Drawer Management ---------------- */
        // function openDrawer(id){
        //   const g = GUESTS.find(x=>x.id===id);
        //   if(!g) return;
        //   document.getElementById("drawerAvatar").textContent = initials(g.guest_name);
        //   document.getElementById("drawerName").textContent = g.guest_name;
        //   document.getElementById("drawerMeta").textContent = `${g.phone} · ${g.guest_code}`;
        //   document.getElementById("drawerPills").innerHTML = pill(g.side+"'s side", g.side==="Bride"?"gold":"grey") + pill(g.rsvp, rsvpTone(g.rsvp));
        //   document.getElementById("drawerLink").textContent = `wedsuite.app/abel-anlin/${g.id.toLowerCase()}`;
        //   document.getElementById("drawerOverlay").classList.add("open");
        // }

        /* ---------------- Drawer Management ---------------- */
        // function openDrawer(id){
        //   // Check both property types to find a match safely
        //   const g = GUEST.find(x => x.id === id || x.guest_code === id);

        //   console.log(g);

        //   if(!g) return;

        //   const name = g.guest_name || g.name || "";
        //   const code = g.inv_code || g.id || "";

        //   document.getElementById("drawerAvatar").textContent = initials(name);
        //   document.getElementById("drawerName").textContent = name;
        //   document.getElementById("drawerMeta").textContent = `${g.phone} · ${code}`;
        //   document.getElementById("drawerPills").innerHTML = pill(g.side+"'s side", g.side==="Bride"?"gold":"grey") + pill(g.rsvp, rsvpTone(g.rsvp));
        //   document.getElementById("drawerLink").textContent = `https://rsvp.myvnc.com/aa${code.toLowerCase()}`;
        //   document.getElementById("drawerOverlay").classList.add("open");
        // }


        /* ---------------- Drawer Management & Web API ---------------- */
        let currentGuestForDrawer = null;

        function openDrawer(id) {
            console.log(id);

            const g = GUEST.find(x => x.id === id || x.guest_code === id);
            if (!g) return;

            let events = @json($event);

            currentGuestForDrawer = g; // Keep local reference for sharing actions

            const name = g.guest_name || g.name || "";
            const code = g.inv_code || g.id || "";
            const generatedUrl = `${sett.base_url}/${app}/${code}`;

            document.getElementById("drawerAvatar").textContent = initials(name);
            document.getElementById("drawerName").textContent = name;
            document.getElementById("drawerMeta").textContent = `${g.phone} · ${code}`;
            document.getElementById("drawerLink").textContent = generatedUrl;

            // Set up the WhatsApp dynamic click action link
            const cleanPhone = g.phone.replace(/[^0-9]/g, ''); // Strips spaces, +, hyphens safely

            // Custom message body text
            // const messageText =
            //     `Habari ${name}! ✨\n\nTunayofuraha kukualika kwenye harusi ya ${events.groom_name} & ${events.bride_name}. Bonyeza link hapa chini kufungua kadi yako ya mwaliko rasmi na kuthibitisha kuhudhuria kwako (RSVP):\n\n🔗 ${generatedUrl}`;
            const imageUrl = `${sett.base_url}/${app}/cards/guest_${id}.png`;
            // console.log(imageUrl);
            // return;

            const messageText = `Habari ${name}! ✨\n\n` +
                `Tunayofuraha kukualika kwenye harusi ya ${events.groom_name} & ${events.bride_name}. ` +
                `Bonyeza link hapa chini kufungua kadi yako ya mwaliko rasmi:\n\n` +
                `Tazama kadi: ${imageUrl}`;

                //  const messageText =
                // `Habari ${name}! ✨\n\nTunayofuraha kukualika kwenye harusi ya ${events.groom_name} & ${events.bride_name}. Bonyeza link hapa chini kufungua kadi yako ya mwaliko rasmi na kuthibitisha kuhudhuria kwako (RSVP):\n\n🔗 ${generatedUrl}`;



            const encodedText = encodeURIComponent(messageText);
            document.getElementById("sendWhatsAppBtn").onclick = () => {
                window.open(`https://wa.me/${cleanPhone}?text=${encodedText}`, '_blank');
            };

            document.getElementById("drawerOverlay").classList.add("open");
        }

        function closeDrawer() {
            document.getElementById("drawerOverlay").classList.remove("open");
        }

        // Global Link Clipboard Copy Action
        function copyDrawerLink() {
            const linkText = document.getElementById("drawerLink").textContent;
            // console.log(linkText);

            if (!linkText) return;

            // Prepend protocol so it copies fully formatted
            const fullUrl = `${linkText}`;



            navigator.clipboard.writeText(fullUrl)
                .then(() => {
                    notify("Link Copied", "The unique invitation link was copied to your clipboard!");
                })
                .catch(err => {
                    console.error('Failed to copy text: ', err);
                });
        }

        // function closeDrawer(){
        //   // Fixed the broken syntax chain error
        //   document.getElementById("drawerOverlay").classList.remove("open");
        // }
        // function closeDrawer(){ document.getElementById("drawerOverlay").classList.remove("remove").classList.remove("open"); }

        /* ---------------- Micro-Helpers & Switch Toggles ---------------- */
        function toggleSwitch(el) {
            el.classList.toggle("on");
            el.classList.toggle("off");
        }

        function rsvpTone(status) {
            return status === "Accepted" ? "green" : status === "Declined" ? "red" : status === "Maybe" ? "gold" : "grey";
        }

        function pill(text, tone) {
            return `<span class="pill pill-${tone}">${text}</span>`;
        }

        function initials(name) {
            return name.split(" ").map(n => n[0]).join("").slice(0, 2);
        }

        let toastTimer;

        function notify(title, body) {
            document.getElementById("toastTitle").textContent = title;
            document.getElementById("toastBody").textContent = body;
            const t = document.getElementById("toast");
            t.classList.add("show");
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => t.classList.remove("show"), 3200);
        }

        /* ---------------- Local Seed Arrays & Fallback Data ---------------- */
        const GOLD = "#B4863A",
            GOLD_LIGHT = "#D9B978",
            RED = "#C97C5D";
        const LOCAL_GUEST_BACKUP = [{
                id: "G-0142",
                name: "{{$event->groom_name}} Whitfield",
                phone: "+255 712 334 210",
                side: "Bride",
                inv: "Sent",
                rsvp: "Accepted",
                date: "12 Jun 2026"
            },
            {
                id: "G-0143",
                name: "{{$event->bride_name}} Mwakalinga",
                phone: "+255 754 981 002",
                side: "Groom",
                inv: "Sent",
                rsvp: "Pending",
                date: "12 Jun 2026"
            },
            {
                id: "G-0144",
                name: "Elena Vasquez",
                phone: "+255 688 220 447",
                side: "Bride",
                inv: "Pending",
                rsvp: "—",
                date: "—"
            },
            {
                id: "G-0145",
                name: "David Okoye",
                phone: "+255 713 552 981",
                side: "Groom",
                inv: "Sent",
                rsvp: "Declined",
                date: "10 Jun 2026"
            },
            {
                id: "G-0146",
                name: "Priya Shah",
                phone: "+255 621 004 372",
                side: "Bride",
                inv: "Sent",
                rsvp: "Accepted",
                date: "09 Jun 2026"
            }
        ];




        const STATS = [{
                label: "Total Guests",
                value: stats.totalGuests,
                delta: "+4.2%",
                up: true,
                seed: 30,
                icon: "fa-users"
            },
            {
                label: "Invitations Sent",
                value: stats.sent,
                delta: "+12.8%",
                up: true,
                seed: 26,
                icon: "fa-paper-plane"
            },
            {
                label: "Pending Invitations",
                value: stats.pendingInvitation,
                delta: "-6.1%",
                up: false,
                seed: 10,
                icon: "fa-clock"
            },
            {
                label: "RSVP Accepted",
                value: stats.accepted,
                delta: "+8.4%",
                up: true,
                seed: 22,
                icon: "fa-circle-check"
            },
            {
                label: "RSVP Declined",
                value: stats.declined,
                delta: "+1.3%",
                up: false,
                seed: 8,
                icon: "fa-circle-xmark"
            },
            {
                label: "Pending Responses",
                value: stats.pendingResponse,
                delta: "-3.9%",
                up: false,
                seed: 14,
                icon: "fa-circle-question"
            }
        ];


        const SYNC_HISTORY = [{
                time: "Today, 10:45 AM",
                added: 3,
                updated: 6,
                skipped: 0,
                errors: 0
            },
            {
                time: "Today, 07:00 AM",
                added: 0,
                updated: 2,
                skipped: 1,
                errors: 0
            },
            {
                time: "Yesterday, 9:12 PM",
                added: 5,
                updated: 4,
                skipped: 0,
                errors: 1
            }
        ];

        const TEMPLATES = [{
                name: "Champagne Bloom",
                created: "02 May 2026",
                uses: 214,
                grad: ["#F1E3C6", "#D9B978"]
            },
            {
                name: "Midnight Ivory",
                created: "18 Apr 2026",
                uses: 98,
                grad: ["#2A2521", "#6B6258"]
            },
            {
                name: "Rosé Garden",
                created: "30 Mar 2026",
                uses: 156,
                grad: ["#EAD2CE", "#C97C5D"]
            }
        ];

        const RSVP_SUMMARY = [{
                name: "Accepted",
                value: 312,
                color: GOLD
            },
            {
                name: "Declined",
                value: 58,
                color: RED
            },
            {
                name: "Pending",
                value: 116,
                color: GOLD_LIGHT
            },
            {
                name: "Maybe",
                value: 34,
                color: "#8C8377"
            },
        ];

        const ANALYTICS = [{
                title: "Guest Growth",
                value: "+42 this month",
                seed: 24,
                color: GOLD
            },
            {
                title: "Invitation Delivery Rate",
                value: "97.4%",
                seed: 30,
                color: "#3E7A45"
            },
            {
                title: "Daily Visitors",
                value: "184 today",
                seed: 18,
                color: GOLD
            }
        ];

        /* ---------------- Sparklines & Core UI Render loops ---------------- */
        function trend(seed) {
            return Array.from({
                length: 12
            }, (_, i) => Math.max(4, seed + Math.sin(i / 1.5 + seed) * seed * 0.25 + i * (seed * 0.04)));
        }

        function sparklineChart(canvasId, seed, color) {
            const ctx = document.getElementById(canvasId);
            if (!ctx || typeof Chart === "undefined") return;
            new Chart(ctx, {
                type: "line",
                data: {
                    labels: trend(seed).map((_, i) => i),
                    datasets: [{
                        data: trend(seed),
                        borderColor: color,
                        borderWidth: 2,
                        tension: .4,
                        pointRadius: 0,
                        fill: true,
                        backgroundColor: (ctxObj) => {
                            const g = ctxObj.chart.ctx.createLinearGradient(0, 0, 0, 44);
                            g.addColorStop(0, color + "44");
                            g.addColorStop(1, color + "00");
                            return g;
                        }
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    },
                    scales: {
                        x: {
                            display: false
                        },
                        y: {
                            display: false
                        }
                    }
                }
            });
        }

        // Render dynamic elements on initialize load
        document.addEventListener("DOMContentLoaded", () => {
            fetchGuestsFromPublishedSheet();
            loadGuestsFromDatabase();

            // Populate Non-Table Loop UI Cards
            const statGrid = document.getElementById("statGrid");
            STATS.forEach((s, idx) => {
                statGrid.insertAdjacentHTML("beforeend", `
      <div class="card stat-card">
        <div class="stat-glow"></div>
        <div class="stat-top">
          <div class="stat-icon"><i class="fa-solid ${s.icon}"></i></div>
          <div class="stat-delta ${s.up?'up':'down'}"><i class="fa-solid ${s.up?'fa-arrow-up':'fa-arrow-down'}"></i>${s.delta}</div>
        </div>
        <div class="stat-value serif">${s.value}</div>
        <div class="stat-label">${s.label}</div>
        <div class="stat-chart"><canvas id="stat-spark-${idx}"></canvas></div>
      </div>
    `);
                sparklineChart(`stat-spark-${idx}`, s.seed, s.up ? GOLD : RED);
            });

            document.getElementById("syncHistory").innerHTML = SYNC_HISTORY.map(h => `
    <div class="history-row">
      <div class="history-icon" style="background:${h.errors? '#F6E4E0':'#F5EAD3'}; color:${h.errors?'#B24B34':'#8a6526'};"><i class="fa-solid ${h.errors?'fa-circle-xmark':'fa-circle-check'}"></i></div>
      <div class="history-time">${h.time}</div>
      <div class="history-pills">${pill('+'+h.added+' added','green')}${pill(h.updated+' updated','gold')}</div>
    </div>
  `).join("");

            document.getElementById("templateGrid").innerHTML = TEMPLATES.map(t => `
    <div class="card template-card">
      <div class="template-cover" style="background:linear-gradient(160deg, ${t.grad[0]}, ${t.grad[1]});"><div class="template-cover-name serif">${t.name}</div></div>
      <div class="template-body"><div class="template-meta"><span>Created ${t.created}</span><span>${t.uses} uses</span></div></div>
    </div>
  `).join("");

            document.getElementById("rsvpGrid").innerHTML = RSVP_SUMMARY.map(r => `
    <div class="card rsvp-card">
      <div class="mini-title">${r.name}</div>
      <div class="rsvp-value serif">${r.value}</div>
      <div class="rsvp-bar"><div class="rsvp-bar-fill" style="width:${(r.value/520)*100}%; background:${r.color};"></div></div>
    </div>
  `).join("");

            const analyticsGrid = document.getElementById("analyticsGrid");
            ANALYTICS.forEach((a, idx) => {
                analyticsGrid.insertAdjacentHTML("beforeend", `
      <div class="card mini-card">
        <div class="mini-title">${a.title}</div>
        <div class="mini-value serif">${a.value}</div>
        <div class="mini-chart"><canvas id="analytics-spark-${idx}"></canvas></div>
      </div>
    `);
                sparklineChart(`analytics-spark-${idx}`, a.seed, a.color);
            });

            // Load Primary Charts
            if (typeof Chart !== "undefined") {
                new Chart(document.getElementById("rsvpMomentum"), {
                    type: "line",
                    data: {
                        labels: ["D1", "D2", "D3", "D4", "D5", "D6", "D7", "D8", "D9", "D10"],
                        datasets: [{
                            data: [20, 40, 45, 70, 82, 120, 150, 190, 240, 312],
                            borderColor: GOLD,
                            pointRadius: 0,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                display: false
                            },
                            y: {
                                display: false
                            }
                        }
                    }
                });
                window.rsvpPieChart = new Chart(document.getElementById("rsvpPie"), {
                    type: "doughnut",
                    data: {
                        labels: RSVP_SUMMARY.map(r => r.name),
                        datasets: [{
                            data: RSVP_SUMMARY.map(r => r.value),
                            backgroundColor: RSVP_SUMMARY.map(r => r.color)
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: "70%",
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }



        });

        /* ---------------- Bulk Operations & Batch Generators ---------------- */

        // Master toggle configuration rule for selecting/deselecting visible table listings
        // function toggleSelectAllGuests(masterCanvasCheckbox) {
        //     const visibleCheckboxes = document.querySelectorAll(".guest-select-checkbox");
        //     visibleCheckboxes.forEach(box => {
        //         box.checked = masterCanvasCheckbox.checked;
        //     });
        // }

        function toggleSelectAllGuests(master) {
            // Only affect rows that are currently visible (respects the search filter)
            document.querySelectorAll("#guestTableBody tr").forEach(tr => {
                if (tr.style.display === "none") return;
                const cb = tr.querySelector(".guest-select-checkbox");
                if (!cb) return;
                cb.checked = master.checked;
                const id = String(cb.dataset.code);
                if (master.checked) selectedGuests.add(id);
                else selectedGuests.delete(id);
            });
        }

        // Processing interface layout architecture mapping structured array payloads


        function processBulkCardGenerationPipeline() {
            const selectedBoxes = document.querySelectorAll(".guest-select-checkbox:checked");
            //console.log(selectedBoxes);


            if (selectedBoxes.length === 0) {
                notify("Selection Required", "Please choose at least one guest via checkboxes first.");
                return;
            }

            const btnBulk = document.getElementById("bulk-generate-btn");
            btnBulk.innerText = "PROCESSING BATCH...";
            btnBulk.disabled = true;

            // Extract JUST the array of token strings from the checkboxes
            const selectedTokens = Array.from(selectedBoxes).map(box => box.getAttribute("data-code"));

            // Package the exact layout expected by your backend checks
            const bulkPayloadObject = {
                guest_app: stats.app || "", // Extracted globally for the event lookups
                guest_tokens: selectedTokens, // Array of token strings passed together
                attendance: "Accepted",
                adults: "1",
                children: "0",
                messages: "Bulk generation pipeline"
            };

            const targetLaravelBackendUrl = "/generate";

            fetch(targetLaravelBackendUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(bulkPayloadObject) // Dispatched as a single cohesive object block
                })
                .then(response => {
                    if (!response.ok) throw new Error("Backend batch processing failure.");
                    return response.json();
                })
                .then(data => {
                    console.log("Bulk generation complete:", data);
                    notify("Success", `Successfully processed invitation cards for selected guests!`);

                    // Clear checkmarks on success
                    selectedBoxes.forEach(box => box.checked = false);
                    const masterCheckbox = document.getElementById("selectAllGuests");
                    if (masterCheckbox) masterCheckbox.checked = false;
                })
                .catch(err => {
                    console.error("Laravel processing error down layout line:", err);
                    notify("Error", "Batch processing failed on the server.");
                })
                .finally(() => {
                    // location.reload();
                    btnBulk.innerHTML = '<i class="fa-solid fa-images"></i>Generate Cards';
                    btnBulk.disabled = false;
                });
        }
        function processBulkDeletePipeline() {
            const selectedBoxes = document.querySelectorAll(".guest-select-checkbox:checked");
            //console.log(selectedBoxes);


            if (selectedBoxes.length === 0) {
                notify("Selection Required", "Please choose at least one guest via checkboxes first.");
                return;
            }

            const btnBulk = document.getElementById("bulk-generate-btn");
            btnBulk.innerText = "PROCESSING BATCH...";
            btnBulk.disabled = true;

            // Extract JUST the array of token strings from the checkboxes
            const selectedTokens = Array.from(selectedBoxes).map(box => box.getAttribute("data-code"));

            // Package the exact layout expected by your backend checks
            const bulkPayloadObject = {
                guest_app: stats.app || "", // Extracted globally for the event lookups
                guest_tokens: selectedTokens, // Array of token strings passed together
                attendance: "Pending",
                adults: "1",
                children: "0",
                messages: "Bulk generation pipeline"
            };

            const targetLaravelBackendUrl = "/deleteCards";

            fetch(targetLaravelBackendUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(bulkPayloadObject) // Dispatched as a single cohesive object block
                })
                .then(response => {
                    if (!response.ok) throw new Error("Backend batch processing failure.");
                    return response.json();
                })
                .then(data => {
                    console.log("Bulk generation complete:", data);
                    notify("Success", `Successfully processed invitation cards for selected guests!`);

                    // Clear checkmarks on success
                    selectedBoxes.forEach(box => box.checked = false);
                    const masterCheckbox = document.getElementById("selectAllGuests");
                    if (masterCheckbox) masterCheckbox.checked = false;
                })
                .catch(err => {
                    console.error("Laravel processing error down layout line:", err);
                    notify("Error", "Batch processing failed on the server.");
                })
                .finally(() => {
                    // location.reload();
                    btnBulk.innerHTML = '<i class="fa-solid fa-images"></i>Generate Cards';
                    btnBulk.disabled = false;
                });
        }


        function processBulkdownloadCardsPipeline() {

    const selectedBoxes = document.querySelectorAll(
        ".guest-select-checkbox:checked"
    );

    if (selectedBoxes.length === 0) {
        notify(
            "Selection Required",
            "Please choose at least one guest via checkboxes first."
        );
        return;
    }

    const btnBulk = document.getElementById("bulk-generate-btn");

    btnBulk.innerText = "PROCESSING BATCH...";
    btnBulk.disabled = true;


    // Get invitation tokens from selected checkboxes
    const selectedTokens = Array.from(selectedBoxes).map(box =>
        box.getAttribute("data-code")
    );


    const bulkPayloadObject = {
        guest_app: stats.app || "",
        guest_tokens: selectedTokens
    };


    const targetLaravelBackendUrl = "/downloadCards";


    fetch(targetLaravelBackendUrl, {

        method: "POST",

        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        },

        body: JSON.stringify(bulkPayloadObject)

    })

    .then(async response => {

        if (!response.ok) {

            // Try to get Laravel's JSON error
            let errorMessage = "Backend batch processing failure.";

            try {
                const errorData = await response.json();

                if (errorData.message) {
                    errorMessage = errorData.message;
                }

            } catch (e) {
                // Response wasn't JSON
            }

            throw new Error(errorMessage);
        }


        // IMPORTANT:
        // Laravel is returning a ZIP, so use blob()
        return response.blob();
    })


    .then(blob => {

        console.log("ZIP generated successfully:", blob);


        // Create temporary URL for ZIP
        const downloadUrl = window.URL.createObjectURL(blob);


        // Create temporary download link
        const downloadLink = document.createElement("a");

        downloadLink.href = downloadUrl;

        downloadLink.download = "selected_cards.zip";


        document.body.appendChild(downloadLink);

        downloadLink.click();

        downloadLink.remove();


        // Clean up
        window.URL.revokeObjectURL(downloadUrl);


        notify(
            "Success",
            "Selected invitation cards downloaded successfully!"
        );


        // Clear checkboxes
        selectedBoxes.forEach(box => {
            box.checked = false;
        });


        const masterCheckbox =
            document.getElementById("selectAllGuests");

        if (masterCheckbox) {
            masterCheckbox.checked = false;
        }

    })


    .catch(err => {

        console.error(
            "Laravel processing error down layout line:",
            err
        );

        notify(
            "Error",
            err.message || "Batch processing failed on the server."
        );

    })


    .finally(() => {

        btnBulk.innerHTML =
            '<i class="fa-solid fa-images"></i> Download Cards';

        btnBulk.disabled = false;

    });
}

        /* ============================================================
           BULK WHATSAPP SENDER - Add this to your script section
           ============================================================ */

        // Global reference for current sending state
        let isSendingBulkWhatsApp = false;

        /**
         * MAIN FUNCTION: Send WhatsApp to selected guests (or all)
         * Integrates with your existing checkbox system
         */
        function sendBulkWhatsAppInvitations(sendToAll = false) {
            // Get selected guests
            let guestsToSend = [];

            if (sendToAll) {
                guestsToSend = GUEST; // Send to ALL guests
            } else {
                // Get only CHECKED guests from checkboxes
                const selectedBoxes = document.querySelectorAll(".guest-select-checkbox:checked");
                console.log(selectedBoxes.length);


                if (selectedBoxes.length === 0) {
                    notify("Selection Required", "Please check at least one guest or choose 'Send to All'");
                    return;
                }

                // Map checkbox codes back to guest objects
                const selectedCodes = Array.from(selectedBoxes).map(box => box.getAttribute("data-code"));
                guestsToSend = GUEST.filter(g => selectedCodes.includes(g.guest_code || g.id));
            }

            // console.log(guestsToSend,GUEST);




            if (guestsToSend.length === 0) {
                notify("Error", "No guests found to send invitations to.");
                return;
            }

            // Confirmation dialog
            const confirmed = confirm(
                `Send WhatsApp invitations to ${guestsToSend.length} guest(s)?\n\nThis will open multiple WhatsApp windows.`
            );

            if (!confirmed) return;

            // Prevent duplicate clicks
            if (isSendingBulkWhatsApp) return;
            isSendingBulkWhatsApp = true;

            const btnWhatsApp = document.getElementById("bulk-whatsapp-btn");
            if (btnWhatsApp) {
                btnWhatsApp.innerText = "SENDING...";
                btnWhatsApp.disabled = true;
            }

            // Send to each guest with delay
            guestsToSend.forEach((guest, index) => {
                setTimeout(() => {
                    sendWhatsAppToGuest(guest);
                }, index * 800); // 800ms delay between sends (adjust as needed)
            });

            // Show completion message
            setTimeout(() => {
                notify("Success", `Opening WhatsApp for ${guestsToSend.length} guest(s)...`);

                if (btnWhatsApp) {
                    btnWhatsApp.innerHTML = '<i class="fa-brands fa-whatsapp"></i> Send WhatsApp';
                    btnWhatsApp.disabled = false;
                }
                isSendingBulkWhatsApp = false;

                // Optional: uncheck all boxes after sending
                document.querySelectorAll(".guest-select-checkbox").forEach(box => box.checked = false);
                const masterCheckbox = document.getElementById("selectAllGuests");
                if (masterCheckbox) masterCheckbox.checked = false;
            }, guestsToSend.length * 800 + 1000);
        }

        /**
         * HELPER FUNCTION: Send WhatsApp message to individual guest
         */
        function sendWhatsAppToGuest(guest) {
            // Get event data (make sure this is available globally)
            let events = window.currentEventData || {}; // Adjust if your event data is stored differently

            // Extract guest info
            const name = guest.guest_name || guest.name || "Guest";
            const code = guest.inv_code || guest.id || "";
            const phone = guest.phone || "";

            // Validate phone
            if (!phone || phone.trim() === "") {
                console.warn(`No phone for guest: ${name}`);
                return;
            }

            // Generate invitation URL
            const baseUrl = window.location.origin; // or use: window.sett?.base_url || window.location.origin
            const app = window.stats?.app || "app"; // Your app identifier
            const generatedUrl = `${baseUrl}/${app}/${code}`;

            // Create personalized message in Swahili
            const messageText =
                `Habari ${name}! ✨\n\nTunayofuraha kukualika kwenye harusi ya ${events.groom_name || 'Groom'} & ${events.bride_name || 'Bride'}. Bonyeza link hapa chini kufungua kadi yako ya mwaliko rasmi na kuthibitisha kuhudhuria kwako (RSVP):\n\n🔗 ${generatedUrl}`;

            // Clean phone number (remove all non-digits)
            const cleanPhone = phone.replace(/[^0-9]/g, '');

            // Encode message for URL
            const encodedText = encodeURIComponent(messageText);

            // Open WhatsApp
            const whatsappUrl = `https://wa.me/${cleanPhone}?text=${encodedText}`;
            window.open(whatsappUrl, '_blank');
        }

        /**
         * OPTIONAL: Send to a single guest from the drawer
         * (This is what you already have, but enhanced)
         */
        function openDrawerAndSetupWhatsApp(id) {
            const g = GUEST.find(x => x.id === id || x.guest_code === id);
            if (!g) return;

            let events = window.currentEventData || {};

            const name = g.guest_name || g.name || "";
            const code = g.inv_code || g.id || "";
            const baseUrl = window.location.origin;
            const app = window.stats?.app || "app";
            const generatedUrl = `${baseUrl}/${app}/${code}`;

            // Update drawer UI
            document.getElementById("drawerAvatar").textContent = initials(name);
            document.getElementById("drawerName").textContent = name;
            document.getElementById("drawerMeta").textContent = `${g.phone} · ${code}`;
            document.getElementById("drawerLink").textContent = generatedUrl;

            // Setup WhatsApp button
            const cleanPhone = g.phone.replace(/[^0-9]/g, '');
            const messageText =
                `Habari ${name}! ✨\n\nTunayofuraha kukualika kwenye harusi ya ${events.groom_name} & ${events.bride_name}. Bonyeza link hapa chini kufungua kadi yako ya mwaliko rasmi na kuthibitisha kuhudhuria kwako (RSVP):\n\n🔗 ${generatedUrl}`;
            const encodedText = encodeURIComponent(messageText);

            document.getElementById("sendWhatsAppBtn").onclick = () => {
                window.open(`https://wa.me/${cleanPhone}?text=${encodedText}`, '_blank');
            };

            document.getElementById("drawerOverlay").classList.add("open");
        }

        // Store event data globally when page loads
        document.addEventListener("DOMContentLoaded", () => {
            // Capture event data - adjust selector based on your template
            window.currentEventData = {
                groom_name: document.querySelector("[data-groom-name]")?.textContent || "Groom",
                bride_name: document.querySelector("[data-bride-name]")?.textContent || "Bride"
            };
        });
    </script>

    <script>
        // Make event data globally available
        window.currentEventData = {
            groom_name: '{{ $event->groom_name }}',
            bride_name: '{{ $event->bride_name }}'
        };

        // Make stats/settings available
        window.stats = {
            app: '{{ $app }}' // or however you get your app identifier
        };

        window.sett = {
            base_url: '{{ config('app.url') }}'
        };

        function toggleGuest(cb) {

    const id = cb.dataset.code;

    if (cb.checked) {
        selectedGuests.add(id);
    } else {
        selectedGuests.delete(id);
    }

}
    </script>
</body>

</html>
