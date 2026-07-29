<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshMart</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: #f0f7f0;
            color: #1a2e1a;
            min-height: 100vh;
        }

        header {
            background-color: #2d6a2d;
            padding: 2.5rem 2rem;
            text-align: center;
        }

        header h1 {
            font-size: 2.8rem;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        header p {
            margin-top: 0.4rem;
            font-size: 1.05rem;
            color: #a8d5a8;
        }

        main {
            max-width: 900px;
            margin: 2.5rem auto;
            padding: 0 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            overflow: hidden;
        }

        .card-header {
            background-color: #e8f5e8;
            padding: 1.2rem 1.8rem;
            border-bottom: 1px solid #c8e6c8;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .card-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2d6a2d;
        }

        /* Responsive table wrapper */
        .table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 400px; /* prevents columns from squishing too much */
        }

        thead {
            background-color: #f5faf5;
        }

        th {
            padding: 0.9rem 1.8rem;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #5a8a5a;
            border-bottom: 1px solid #e0ede0;
            white-space: nowrap;
        }

        td {
            padding: 0.95rem 1.8rem;
            font-size: 0.95rem;
            color: #2a3d2a;
            border-bottom: 1px solid #f0f5f0;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f8fcf8;
        }

        .badge {
            display: inline-block;
            padding: 0.2rem 0.65rem;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 500;
            background-color: #e8f5e8;
            color: #2d6a2d;
        }

        /* Error state */
        .service-error {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1.2rem 1.8rem;
            background-color: #fff8f0;
            border-left: 4px solid #e8923a;
            color: #8a4a1a;
            font-size: 0.95rem;
        }

        .service-error span.icon {
            font-size: 1.3rem;
        }

        .service-error p {
            font-weight: 500;
        }

        .service-error small {
            display: block;
            margin-top: 0.2rem;
            font-weight: 400;
            color: #aa6a3a;
        }

        footer {
            text-align: center;
            padding: 2.5rem 1rem;
            font-size: 0.82rem;
            color: #6a8a6a;
            line-height: 1.8;
        }

        footer .footer-title {
            font-weight: 600;
            font-size: 0.9rem;
            color: #2d6a2d;
            margin-bottom: 0.3rem;
        }

        footer .stack {
            color: #8aaa8a;
            letter-spacing: 0.03em;
        }

        footer .author {
            margin-top: 0.4rem;
            color: #8aaa8a;
        }

        /* ── Responsive ── */
        @media (max-width: 600px) {
            header {
                padding: 1.8rem 1rem;
            }

            header h1 {
                font-size: 2rem;
            }

            header p {
                font-size: 0.9rem;
            }

            main {
                margin: 1.5rem auto;
                padding: 0 1rem;
                gap: 1.2rem;
            }

            .card-header {
                padding: 1rem 1.2rem;
            }

            .card-header h2 {
                font-size: 1.1rem;
            }

            th {
                padding: 0.75rem 1rem;
                font-size: 0.7rem;
            }

            td {
                padding: 0.75rem 1rem;
                font-size: 0.88rem;
            }

            .service-error {
                padding: 1rem 1.2rem;
                font-size: 0.88rem;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>🌿 FreshMart</h1>
    <p>Fresh fruits and vegetables, straight from the source</p>
</header>

<main>

    <!-- Fruits card -->
    <div class="card">
        <div class="card-header">
            <h2>🍎 Fruits</h2>
        </div>
        <?php
            $fruitsData = @file_get_contents('http://fruit-service');
            if ($fruitsData === false):
        ?>
            <div class="service-error">
                <span class="icon">⚠️</span>
                <div>
                    <p>Fruit Service Unavailable</p>
                    <small>The fruit service is currently unreachable. Please try again later.</small>
                </div>
            </div>
        <?php else:
            $obj = json_decode($fruitsData);
            if (!$obj || !isset($obj->fruits)):
        ?>
            <div class="service-error">
                <span class="icon">⚠️</span>
                <div>
                    <p>Unexpected Response</p>
                    <small>The fruit service returned invalid data.</small>
                </div>
            </div>
        <?php else: ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Season</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($obj->fruits as $fruit): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($fruit->name) ?></strong></td>
                            <td><span class="badge"><?= htmlspecialchars($fruit->category) ?></span></td>
                            <td><?= htmlspecialchars($fruit->season) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; endif; ?>
    </div>

    <!-- Vegetables card -->
    <div class="card">
        <div class="card-header">
            <h2>🥦 Vegetables</h2>
        </div>
        <?php
            $vegsData = @file_get_contents('http://vegetable-service/vegetables');
            if ($vegsData === false):
        ?>
            <div class="service-error">
                <span class="icon">⚠️</span>
                <div>
                    <p>Vegetable Service Unavailable</p>
                    <small>The vegetable service is currently unreachable. Please try again later.</small>
                </div>
            </div>
        <?php else:
            $obj = json_decode($vegsData);
            if (!$obj || !isset($obj->vegetables)):
        ?>
            <div class="service-error">
                <span class="icon">⚠️</span>
                <div>
                    <p>Unexpected Response</p>
                    <small>The vegetable service returned invalid data.</small>
                </div>
            </div>
        <?php else: ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Season</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($obj->vegetables as $veg): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($veg->name) ?></strong></td>
                            <td><span class="badge"><?= htmlspecialchars($veg->category) ?></span></td>
                            <td><?= htmlspecialchars($veg->season) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; endif; ?>
    </div>

</main>

<footer>
    <div class="footer-title">FreshMart Demo</div>
    <div class="stack">Flask &bull; PHP &bull; PostgreSQL &bull; Docker Compose</div>
    <div class="author">Developed by Audrey &mdash; Cloud Native Demo Application</div>
</footer>

</body>
</html>