<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Online Voting System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
    body {
        background-image: radial-gradient(circle at 20% 100%,
                rgba(184, 184, 184, 0.1) 0%,
                rgba(184, 184, 184, 0.1) 33%,
                rgba(96, 96, 96, 0.1) 33%,
                rgba(96, 96, 96, 0.1) 66%,
                rgba(7, 7, 7, 0.1) 66%,
                rgba(7, 7, 7, 0.1) 99%),
            linear-gradient(40deg, #040a22, #162561, #202e64, #6f7aa6);
        background-repeat: no-repeat;
        background-size: cover;
    }

    section {
        display: grid;
        grid-template-columns: 50% 45%;
        place-items: center;
        gap: 60px;
        min-height: 100vh;
        padding: 20px 60px;
    }

    .content h1 {
        font-family: "Comfortaa", sans-serif;
        font-size: clamp(2rem, 4vw, 3.5rem);
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: 1px;
        margin-bottom: 36px;
        color: #fff;
    }

    .content p {
        font-size: clamp(1rem, 4vw, 1.1rem);
        font-weight: 300;
        line-height: 1.5;
        margin-bottom: 30px;
        color: #fff;
    }

    button {
        font-size: clamp(0.9rem, 4vw, 1rem);
        font-weight: 600;
        padding: 8px 14px;
        border: 2px solid black;
        border-radius: 9px;
    }

    .swiper {
        position: relative;
        margin-right: 7em;
        width: 400px;
        height: 490px;
    }

    .swiper-slide {
        position: fixed;
        background-position: center;
        background-size: cover;
        border: 18px solid rgba(255, 255, 255, 0.3);
        user-select: none;
        border-radius: 24px;
    }

    .swiper-slide img {
        width: 100%;
        height: 20em;
        border-radius: 10px;
    }

    .overlay {
        background: rgb(14 16 65 / 20%);
        color: #f7f3f3;
    }

    .overlay h1 {
        font-size: clamp(1.2rem, 4vw, 1.5rem);
        font-weight: 600;
    }

    a:hover {
        color: black;

    }
    </style>
</head>

<body>


    <section>
        <div class="content">
            <h1>Online Voting System</h1>
            <p>
                Welcome to our Online Voting Platform, the premier destination for secure, transparent, and
                accessible online voting. Our platform offers a seamless and straightforward voting process for a
                wide range of elections, from local community polls to organizational elections. With cutting-edge
                security and user-friendly design, participating in democracy has never been easier.
            </p>
            <button><a href="index.php" style="text-decoration: none;">Get Started</a></button>
        </div>

        <div class="swiper ">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="img/pht.jpg" />

                    <div class="overlay">
                        <h1>Secure and Easy</h1>
                        <p>
                            Now you can vote Us, from wherever you are at anytime anywhere.
                        </p>

                    </div>
                </div>


            </div>
        </div>
    </section>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    \
</body>

</html>