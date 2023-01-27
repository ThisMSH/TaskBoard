<?php
    session_start();
    if(!isset($_SESSION['ID'])) {
        header("Location: http://localhost/TaskBoard/home/index");
    }else {
        $tasksObj = new tasksController();
        $getTasks = $tasksObj->getTasks($_SESSION['ID']);
        $do = 0;
        $doing = 0;
        $done = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to TaskBoard Where you can manage and organize your tasks.">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;500;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/tailwind_style.css">
    <script defer src="../public/js/script.js"></script>
    <link rel="shortcut icon" href="../public/imgs/logo/letter-t-6-512.png" type="image/x-icon">
    <title>Your Board - TaskBoard</title>
</head>
<!-- 
sm	640px	@media (min-width: 640px) { ... }
md	768px	@media (min-width: 768px) { ... }
lg	1024px	@media (min-width: 1024px) { ... }
xl	1280px	@media (min-width: 1280px) { ... }
2xl	1536px	@media (min-width: 1536px) { ... } 
-->
<body class="font-poppins text-slate-100 bg-slate-900">
    <!-- Breakpoints of TailwindCSS -->
    <!-- <div class="absolute top-96 left-4 z-50">
        <p class="text-4xl font-bold block sm:hidden">ESM</p>
        <p class="text-4xl font-bold hidden sm:block md:hidden">SM</p>
        <p class="text-4xl font-bold hidden md:block lg:hidden">MD</p>
        <p class="text-4xl font-bold hidden lg:block xl:hidden">LG</p>
        <p class="text-4xl font-bold hidden xl:block 2xl:hidden">XL</p>
        <p class="text-4xl font-bold hidden 2xl:block">2XL</p>
    </div> -->
    <!-- add gap in main class later -->
    <div class="grid grid-cols-[0_minmax(0,_1fr)] md:grid md:grid-cols-[16rem_minmax(auto,_1fr)]">
        <aside class="relative h-screen -left-80 md:left-0 z-30 transition-all duration-300" id="side-bar">
            <div class="fixed w-80 md:w-64 h-full bg-slate-900 border-r" id="side-bar-content">
                <!-- logo container -->
                <div class="flex items-center justify-center mt-4">
                    <!-- logo -->
                    <div class="w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 1000 222"><g transform="matrix(1,0,0,1,-0.6060605978049693,0.3066286563992122)"><svg viewBox="0 0 396 88" data-background-color="#ffffff" preserveAspectRatio="xMidYMid meet" height="222" width="1000" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="tight-bounds" transform="matrix(1,0,0,1,0.24000000326924464,-0.1215464944285145)"><svg viewBox="0 0 395.52 88.243092988857" height="88.243092988857" width="395.52"><g><svg viewBox="0 0 524.7138694848563 117.06708833306826" height="88.243092988857" width="395.52"><g transform="matrix(1,0,0,1,0,16.17931539190741)"><svg viewBox="0 0 395.52 84.70845754925344" height="84.70845754925344" width="395.52"><g><svg viewBox="0 0 395.52 84.70845754925344" height="84.70845754925344" width="395.52"><g><svg viewBox="0 0 395.52 51.36812362030904" height="51.36812362030904" width="395.52"><g transform="matrix(1,0,0,1,0,0)"><svg width="395.52" viewBox="0.4000000059604645 -34.900001525878906 271.7799987792969 35.30000305175781" height="51.36812362030904" data-palette-color="#0063db"><path d="M0.4-34.45L28.4-34.45 28.4-27.3 25.25-26.9Q24.6-27.4 24-29L24-29 18-29 18-5.8Q20-5 20.75-4.15L20.75-4.15 20.25 0 8.55 0 8.05-4.15Q8.7-5 10.8-5.8L10.8-5.8 10.8-29 4.8-29Q4.2-27.4 3.55-26.9L3.55-26.9 0.4-27.3 0.4-34.45ZM38.1-34.75L44.95-34.75 54.9-5.9Q57-5.15 57.85-4.15L57.85-4.15 57.35 0 45.65 0 45.15-4.15Q45.75-4.95 47.55-5.65L47.55-5.65 46.2-9.85 36.2-9.85 34.95-5.8Q36.7-5.1 37.55-4.15L37.55-4.15 37.05 0 25.65 0 25.15-4.15Q26.05-5.3 28.5-6.05L28.5-6.05 38.1-34.75ZM41.5-27.75L40.8-27.75Q40.8-24.7 39.55-20.65L39.55-20.65 37.6-14.45 44.75-14.45 42.85-20.55Q41.7-24.05 41.55-26.9L41.55-26.9 41.5-27.75ZM74.69-29.05L74.69-29.05Q73-29.5 71.14-29.5 69.3-29.5 68.17-28.58 67.05-27.65 67.05-25.98 67.05-24.3 67.89-23.35 68.75-22.4 71.25-21.7L71.25-21.7 75.69-20.4Q79.3-19.35 81.42-17.13 83.55-14.9 83.55-10.6L83.55-10.6Q83.55-5.5 79.87-2.55 76.19 0.4 70.75 0.4L70.75 0.4Q67.75 0.4 64.57-0.38 61.4-1.15 59.3-2.55L59.3-2.55Q59.3-2.85 59.3-3.7 59.3-4.55 59.65-6.6 59.99-8.65 60.65-9.95L60.65-9.95 65.39-9.95Q66.19-8.4 66.34-5.8L66.34-5.8Q68.09-5.05 70.42-5.05 72.75-5.05 74.25-6.15 75.75-7.25 75.75-9.3L75.75-9.3Q75.75-10.25 75.59-10.88 75.44-11.5 74.67-12.23 73.89-12.95 72.44-13.4L72.44-13.4 67.3-14.9Q59.45-17.15 59.45-24.9L59.45-24.9Q59.45-29.45 62.75-32.18 66.05-34.9 71.37-34.9 76.69-34.9 81.8-32.5L81.8-32.5Q81.8-32.2 81.8-31.35 81.8-30.5 81.44-28.45 81.09-26.4 80.44-25.1L80.44-25.1 75.69-25.1Q74.84-26.3 74.69-29.05ZM116.34-4.15L115.84 0 107.54 0 96.44-18 104.79-29.1Q103.39-29.75 102.84-30.45L102.84-30.45 103.34-34.5 114.74-34.5 115.24-30.45Q114.54-29.65 112.64-28.85L112.64-28.85 103.99-18.2 111.89-6.3Q115.14-5.6 116.34-4.15L116.34-4.15ZM86.69-34.5L98.39-34.5 98.89-30.35Q98.09-29.4 96.14-28.65L96.14-28.65 96.14-5.8Q98.14-5 98.89-4.15L98.89-4.15 98.39 0 86.69 0 86.19-4.15Q86.84-5 88.94-5.8L88.94-5.8 88.94-28.65Q86.89-29.4 86.19-30.35L86.19-30.35 86.69-34.5ZM118.04-34.5L129.39-34.5Q135.29-34.5 137.97-33.77 140.64-33.05 141.79-32.05L141.79-32.05Q144.34-29.85 144.34-25.3L144.34-25.3Q144.34-21.9 140.69-18.85L140.69-18.85Q145.34-16.5 145.34-10.1L145.34-10.1Q145.34-5.1 142.06-2.68 138.79-0.25 132.29 0L132.29 0 118.04 0 117.54-4.15Q118.19-5 120.29-5.8L120.29-5.8 120.29-28.65Q118.24-29.4 117.54-30.35L117.54-30.35 118.04-34.5ZM131.94-14.95L131.94-14.95 127.49-14.95 127.49-5.45 130.94-5.45Q134.34-5.45 136.09-6.45 137.84-7.45 137.84-10.05 137.84-12.65 136.47-13.8 135.09-14.95 131.94-14.95ZM130.09-29.05L130.09-29.05 127.49-29.05 127.49-20.4 131.59-20.4Q134.14-20.4 135.49-21.7 136.84-23 136.84-24.88 136.84-26.75 135.89-27.7 134.94-28.65 133.69-28.85 132.44-29.05 130.09-29.05ZM162.44 0.4Q155.34 0.4 151.81-3.7 148.29-7.8 148.29-16.98 148.29-26.15 152.16-30.53 156.04-34.9 163.21-34.9 170.39-34.9 173.91-31 177.44-27.1 177.44-17.95 177.44-8.8 173.49-4.2 169.54 0.4 162.44 0.4ZM157.59-26.65Q155.79-24.05 155.79-17.6 155.79-11.15 157.69-8.2 159.59-5.25 162.91-5.25 166.24-5.25 168.09-8.03 169.94-10.8 169.94-17.25L169.94-17.25Q169.94-29.25 162.74-29.25L162.74-29.25Q159.39-29.25 157.59-26.65ZM190.44-34.75L197.28-34.75 207.24-5.9Q209.34-5.15 210.19-4.15L210.19-4.15 209.69 0 197.99 0 197.49-4.15Q198.09-4.95 199.88-5.65L199.88-5.65 198.53-9.85 188.53-9.85 187.28-5.8Q189.03-5.1 189.88-4.15L189.88-4.15 189.38 0 177.98 0 177.48-4.15Q178.38-5.3 180.84-6.05L180.84-6.05 190.44-34.75ZM193.84-27.75L193.13-27.75Q193.13-24.7 191.88-20.65L191.88-20.65 189.94-14.45 197.09-14.45 195.19-20.55Q194.03-24.05 193.88-26.9L193.88-26.9 193.84-27.75ZM238.68-24.4L238.68-24.4Q238.68-21 236.56-18.7 234.43-16.4 231.23-15.2L231.23-15.2Q233.73-14.15 234.53-12.65L234.53-12.65 238.18-5.7Q240.53-4.9 241.38-3.85L241.38-3.85 240.88 0 232.43 0 226.68-12.25Q225.88-14.1 224.83-14.1L224.83-14.1 221.58-14.1 221.58-6.1Q225.23-5.3 226.13-4.15L226.13-4.15 225.63 0 212.13 0 211.63-4.15Q212.28-5 214.38-5.8L214.38-5.8 214.38-28.65Q212.33-29.4 211.63-30.35L211.63-30.35 212.13-34.5 224.88-34.5Q231.88-34.4 235.28-32.25 238.68-30.1 238.68-24.4ZM224.53-29.05L224.53-29.05 221.58-29.05 221.58-19.55 224.43-19.55Q227.83-19.55 229.51-20.58 231.18-21.6 231.18-24.25 231.18-26.9 229.48-27.98 227.78-29.05 224.53-29.05ZM256.28 0L256.28 0 243.53 0 243.03-4.15Q243.68-5 245.78-5.8L245.78-5.8 245.78-28.65Q243.73-29.4 243.03-30.35L243.03-30.35 243.53-34.5 254.68-34.5Q262.73-34.5 267.45-30 272.18-25.5 272.18-16.78 272.18-8.05 267.91-4.03 263.63 0 256.28 0ZM252.98-29.05L252.98-5.45 256.58-5.45Q260.33-5.45 262.5-7.73 264.68-10 264.68-16.55L264.68-16.55Q264.68-29.05 255.23-29.05L255.23-29.05 252.98-29.05Z" opacity="1" transform="matrix(1,0,0,1,0,0)" fill="#0063db" class="undefined-text-0" data-fill-palette-color="primary" id="text-0"></path></svg></g></svg></g><g transform="matrix(1,0,0,1,163.310208,63.49490477209712)"><svg viewBox="0 0 232.209792 21.213552777156313" height="21.213552777156313" width="232.209792"><g transform="matrix(1,0,0,1,0,0)"><svg width="232.209792" viewBox="1.600000023841858 -36.150001525878906 509.5 46.55000305175781" height="21.213552777156313" data-palette-color="#0063db"><path d="M2.1-34.5L24.9-34.5 24.9-25.8 21.2-25.35Q20.05-26.35 19.35-29.05L19.35-29.05 11.55-29.05 11.55-19.95 18.5-19.95Q19.1-21.45 19.75-22.05L19.75-22.05 22.9-21.7 22.9-12.8 19.75-12.4Q19.1-12.9 18.5-14.5L18.5-14.5 11.55-14.5 11.55-6.2Q14.9-5.45 16.4-4.15L16.4-4.15 15.9 0 2.1 0 1.6-4.15Q2.25-5 4.35-5.8L4.35-5.8 4.35-28.65Q2.3-29.4 1.6-30.35L1.6-30.35 2.1-34.5ZM38.27 0.4Q32.35 0.4 29.5-2.75 26.65-5.9 26.65-12.28 26.65-18.65 29.82-22.03 33-25.4 38.95-25.4 44.9-25.4 47.77-22.4 50.65-19.4 50.65-13.03 50.65-6.65 47.42-3.13 44.2 0.4 38.27 0.4ZM33.85-12.7L33.85-12.7Q33.85-4.7 38.65-4.7L38.65-4.7Q41.1-4.7 42.27-6.53 43.45-8.35 43.45-12.5L43.45-12.5Q43.45-20.3 38.55-20.3L38.55-20.3Q36.15-20.3 35-18.57 33.85-16.85 33.85-12.7ZM68.2-18.85L68.2-18.85Q64.4-18.85 62.95-17.4L62.95-17.4 62.95-5.95Q67-5.2 68.5-3.85L68.5-3.85 68 0 53.7 0 53.2-3.85Q53.9-4.8 55.95-5.55L55.95-5.55 55.95-19.45Q54.2-20.05 53.2-21.15L53.2-21.15 53.7-25Q56.45-25.6 58.65-25.6 60.85-25.6 62.3-25.5L62.3-25.5 62.3-22.35Q63.45-23.7 65.25-24.58 67.05-25.45 68.52-25.45 70-25.45 70.55-25.2L70.55-25.2 70.4-18.7Q69.4-18.85 68.2-18.85ZM82.94-34.45L110.94-34.45 110.94-27.3 107.79-26.9Q107.14-27.4 106.54-29L106.54-29 100.54-29 100.54-5.8Q102.54-5 103.29-4.15L103.29-4.15 102.79 0 91.09 0 90.59-4.15Q91.24-5 93.34-5.8L93.34-5.8 93.34-29 87.34-29Q86.74-27.4 86.09-26.9L86.09-26.9 82.94-27.3 82.94-34.45ZM110.09-21.3L110.09-21.3Q110.09-22.05 110.14-22.9L110.14-22.9Q114.79-25.4 120.14-25.4 125.49-25.4 127.81-23.38 130.14-21.35 130.14-16.65L130.14-16.65 130.14-6Q131.89-5.65 132.89-5.15L132.89-5.15 132.89-0.8Q130.34 0.4 125.59 0.4L125.59 0.4Q125.09-0.9 124.74-2.75L124.74-2.75Q122.59 0.4 116.94 0.4L116.94 0.4Q113.59 0.4 111.21-1.55 108.84-3.5 108.84-6.85 108.84-10.2 111.06-12.13 113.29-14.05 117.69-14.05L117.69-14.05 123.14-14.05 123.14-16.45Q123.14-20.35 118.99-20.35L118.99-20.35Q117.44-20.35 116.44-20.05L116.44-20.05Q116.34-17.95 115.84-16.8L115.84-16.8 110.94-16.8Q110.09-18.55 110.09-21.3ZM119.09-4.7L119.09-4.7Q121.64-4.7 123.14-6.2L123.14-6.2 123.14-10.3 119.64-10.3Q116.04-10.3 116.04-7.55L116.04-7.55Q116.04-6.3 116.81-5.5 117.59-4.7 119.09-4.7ZM144.69-20.9L144.69-20.9Q141.39-20.9 141.39-18.95L141.39-18.95Q141.39-17.1 144.84-16.2L144.84-16.2 148.79-15.15Q154.89-13.55 154.89-8.1L154.89-8.1Q154.89-4.35 152.26-1.98 149.64 0.4 143.91 0.4 138.19 0.4 134.99-1.2L134.99-1.2Q134.94-1.75 134.94-2.3L134.94-2.3Q134.94-5.05 136.04-7.25L136.04-7.25 140.19-7.25Q140.84-6.05 141.04-4.75L141.04-4.75Q142.04-4.45 143.89-4.45L143.89-4.45Q148.29-4.45 148.29-6.95L148.29-6.95Q148.29-7.75 147.69-8.28 147.09-8.8 145.34-9.3L145.34-9.3 141.39-10.45Q138.34-11.3 136.64-12.98 134.94-14.65 134.94-17.93 134.94-21.2 137.59-23.3 140.24-25.4 145.16-25.4 150.09-25.4 153.49-23.95L153.49-23.95Q153.54-23.45 153.54-22.95L153.54-22.95Q153.54-20.35 152.44-18.15L152.44-18.15 148.34-18.15Q147.69-19.3 147.49-20.55L147.49-20.55Q146.09-20.9 144.69-20.9ZM156.63-31.65L157.13-35.5Q159.93-36.15 162.33-36.15 164.73-36.15 166.38-36L166.38-36 166.38-5.55Q168.33-4.8 169.13-3.85L169.13-3.85 168.63 0 157.13 0 156.63-3.85Q157.33-4.8 159.38-5.55L159.38-5.55 159.38-29.95Q157.63-30.55 156.63-31.65L156.63-31.65ZM183.68 0L175.68 0 166.83-12.95 172.33-20.1Q171.48-20.6 171.13-21.15L171.13-21.15 171.63-25 182.63-25 183.13-21.15Q182.03-19.75 178.98-18.95L178.98-18.95 174.18-13.45 179.83-6Q182.93-5.3 184.18-3.85L184.18-3.85 183.68 0ZM195.58-20.9L195.58-20.9Q192.28-20.9 192.28-18.95L192.28-18.95Q192.28-17.1 195.73-16.2L195.73-16.2 199.68-15.15Q205.78-13.55 205.78-8.1L205.78-8.1Q205.78-4.35 203.16-1.98 200.53 0.4 194.81 0.4 189.08 0.4 185.88-1.2L185.88-1.2Q185.83-1.75 185.83-2.3L185.83-2.3Q185.83-5.05 186.93-7.25L186.93-7.25 191.08-7.25Q191.73-6.05 191.93-4.75L191.93-4.75Q192.93-4.45 194.78-4.45L194.78-4.45Q199.18-4.45 199.18-6.95L199.18-6.95Q199.18-7.75 198.58-8.28 197.98-8.8 196.23-9.3L196.23-9.3 192.28-10.45Q189.23-11.3 187.53-12.98 185.83-14.65 185.83-17.93 185.83-21.2 188.48-23.3 191.13-25.4 196.06-25.4 200.98-25.4 204.38-23.95L204.38-23.95Q204.43-23.45 204.43-22.95L204.43-22.95Q204.43-20.35 203.33-18.15L203.33-18.15 199.23-18.15Q198.58-19.3 198.38-20.55L198.38-20.55Q196.98-20.9 195.58-20.9ZM252.13-5.85L252.13-18.85Q252.13-20.85 252.48-25.05L252.48-25.05 252.58-26.25 252.08-26.3Q250.93-22.05 250.08-19.55L250.08-19.55 243.43 0 236.78 0 229.78-19.55Q228.83-21.8 228.08-25.15L228.08-25.15 227.78-26.3 227.28-26.25Q227.73-21.8 227.73-18.85L227.73-18.85 227.73-5.7Q229.58-5 230.48-3.85L230.48-3.85 229.98 0 220.18 0 219.68-3.85Q220.58-5 222.43-5.7L222.43-5.7 222.43-28.8Q220.38-29.55 219.58-30.65L219.58-30.65 220.08-34.5 231.48-34.5 238.78-14.35Q240.18-11.05 240.58-8.3L240.58-8.3 240.73-7.45 241.43-7.45Q241.63-10.5 243.23-14.35L243.23-14.35 250.18-34.5 261.38-34.5 261.88-30.65Q261.08-29.55 259.03-28.8L259.03-28.8 259.03-5.9Q260.98-5.15 261.78-4.15L261.78-4.15 261.28 0 249.88 0 249.38-4.1Q250.18-5.1 252.13-5.85L252.13-5.85ZM265.72-21.3L265.72-21.3Q265.72-22.05 265.77-22.9L265.77-22.9Q270.42-25.4 275.77-25.4 281.12-25.4 283.45-23.38 285.77-21.35 285.77-16.65L285.77-16.65 285.77-6Q287.52-5.65 288.52-5.15L288.52-5.15 288.52-0.8Q285.97 0.4 281.22 0.4L281.22 0.4Q280.72-0.9 280.37-2.75L280.37-2.75Q278.22 0.4 272.57 0.4L272.57 0.4Q269.22 0.4 266.85-1.55 264.47-3.5 264.47-6.85 264.47-10.2 266.7-12.13 268.92-14.05 273.32-14.05L273.32-14.05 278.77-14.05 278.77-16.45Q278.77-20.35 274.62-20.35L274.62-20.35Q273.07-20.35 272.07-20.05L272.07-20.05Q271.97-17.95 271.47-16.8L271.47-16.8 266.57-16.8Q265.72-18.55 265.72-21.3ZM274.72-4.7L274.72-4.7Q277.27-4.7 278.77-6.2L278.77-6.2 278.77-10.3 275.27-10.3Q271.67-10.3 271.67-7.55L271.67-7.55Q271.67-6.3 272.45-5.5 273.22-4.7 274.72-4.7ZM290.32-21.15L290.82-25Q293.57-25.6 295.77-25.6 297.97-25.6 299.42-25.5L299.42-25.5 299.42-23Q300.67-24.05 302.75-24.73 304.82-25.4 306.72-25.4L306.72-25.4Q311.62-25.4 313.6-23.1 315.57-20.8 315.57-15.15L315.57-15.15 315.57-5.55Q317.52-4.8 318.32-3.85L318.32-3.85 317.82 0 306.32 0 305.82-3.85Q306.52-4.8 308.57-5.55L308.57-5.55 308.57-15.45Q308.57-18.15 307.7-19.07 306.82-20 304.57-20 302.32-20 300.07-18.4L300.07-18.4 300.07-5.55Q302.02-4.8 302.82-3.85L302.82-3.85 302.32 0 290.82 0 290.32-3.85Q291.02-4.8 293.07-5.55L293.07-5.55 293.07-19.45Q291.32-20.05 290.32-21.15L290.32-21.15ZM321.07-21.3L321.07-21.3Q321.07-22.05 321.12-22.9L321.12-22.9Q325.77-25.4 331.12-25.4 336.47-25.4 338.79-23.38 341.12-21.35 341.12-16.65L341.12-16.65 341.12-6Q342.87-5.65 343.87-5.15L343.87-5.15 343.87-0.8Q341.32 0.4 336.57 0.4L336.57 0.4Q336.07-0.9 335.72-2.75L335.72-2.75Q333.57 0.4 327.92 0.4L327.92 0.4Q324.57 0.4 322.19-1.55 319.82-3.5 319.82-6.85 319.82-10.2 322.04-12.13 324.27-14.05 328.67-14.05L328.67-14.05 334.12-14.05 334.12-16.45Q334.12-20.35 329.97-20.35L329.97-20.35Q328.42-20.35 327.42-20.05L327.42-20.05Q327.32-17.95 326.82-16.8L326.82-16.8 321.92-16.8Q321.07-18.55 321.07-21.3ZM330.07-4.7L330.07-4.7Q332.62-4.7 334.12-6.2L334.12-6.2 334.12-10.3 330.62-10.3Q327.02-10.3 327.02-7.55L327.02-7.55Q327.02-6.3 327.79-5.5 328.57-4.7 330.07-4.7ZM357.17 5.3L357.17 5.3Q361.62 5.3 361.62-0.05L361.62-0.05 361.62-2.25Q359.17-0.75 355.47-0.75L355.47-0.75Q350.77-0.75 348.24-3.5 345.72-6.25 345.72-12.65L345.72-12.65Q345.72-25.4 357.42-25.4L357.42-25.4Q360.42-25.4 363.02-24.1L363.02-24.1Q363.52-25 364.52-25L364.52-25 368.62-25 368.62-0.4Q368.62 5.1 365.89 7.75 363.17 10.4 357.47 10.4L357.47 10.4Q354.47 10.4 351.27 9.7 348.07 9 346.42 7.95L346.42 7.95Q346.37 7.5 346.37 7.05L346.37 7.05Q346.37 4.3 347.67 1.75L347.67 1.75 352.07 1.75Q352.62 2.8 352.87 4.55L352.87 4.55Q354.77 5.3 357.17 5.3ZM352.62-12.95Q352.62-9.2 353.64-7.7 354.67-6.2 357.14-6.2 359.62-6.2 361.62-7.6L361.62-7.6 361.62-19.45Q359.62-20.3 357.27-20.3L357.27-20.3Q352.62-20.3 352.62-12.95L352.62-12.95ZM384.41 0.4L384.41 0.4Q378.41 0.4 375.39-2.8 372.36-6 372.36-12.1L372.36-12.1Q372.36-15.8 373.41-18.48 374.46-21.15 376.26-22.6L376.26-22.6Q379.76-25.4 384.41-25.4 389.06-25.4 391.54-23.03 394.01-20.65 394.01-14.5L394.01-14.5Q394.01-10.9 390.46-10.9L390.46-10.9 379.61-10.9Q379.81-7.75 381.24-6.45 382.66-5.15 385.76-5.15L385.76-5.15Q387.46-5.15 389.01-5.55 390.56-5.95 391.26-6.35L391.26-6.35 391.96-6.75 393.46-2.75Q393.16-2.4 392.59-1.88 392.01-1.35 389.69-0.48 387.36 0.4 384.41 0.4ZM379.66-15.05L387.56-15.35Q387.66-16.05 387.66-17.05 387.66-18.05 386.86-19.18 386.06-20.3 384.09-20.3 382.11-20.3 381.06-19.1 380.01-17.9 379.66-15.05L379.66-15.05ZM396.56-21.15L397.06-25Q399.81-25.6 402.01-25.6 404.21-25.6 405.66-25.5L405.66-25.5 405.66-23Q406.86-24 408.66-24.7 410.46-25.4 411.91-25.4L411.91-25.4Q417.61-25.4 419.51-22.55L419.51-22.55Q420.76-23.75 422.81-24.58 424.86-25.4 426.61-25.4L426.61-25.4Q432.11-25.4 434.01-22.93 435.91-20.45 435.91-13.65L435.91-13.65 435.91-5.55Q437.86-4.8 438.66-3.85L438.66-3.85 438.16 0 426.66 0 426.16-3.85Q426.86-4.8 428.91-5.55L428.91-5.55 428.91-15.45Q428.91-18.2 428.16-19.1 427.41-20 425.19-20 422.96-20 420.96-18.35L420.96-18.35Q421.21-16.65 421.21-13.65L421.21-13.65 421.21-5.55Q423.16-4.8 423.96-3.85L423.96-3.85 423.46 0 411.96 0 411.46-3.85Q412.16-4.8 414.21-5.55L414.21-5.55 414.21-15.45Q414.21-18.2 413.46-19.1 412.71-20 410.51-20 408.31-20 406.31-18.4L406.31-18.4 406.31-5.55Q408.26-4.8 409.06-3.85L409.06-3.85 408.56 0 397.06 0 396.56-3.85Q397.26-4.8 399.31-5.55L399.31-5.55 399.31-19.45Q397.56-20.05 396.56-21.15L396.56-21.15ZM452.36 0.4L452.36 0.4Q446.36 0.4 443.33-2.8 440.31-6 440.31-12.1L440.31-12.1Q440.31-15.8 441.36-18.48 442.41-21.15 444.21-22.6L444.21-22.6Q447.71-25.4 452.36-25.4 457.01-25.4 459.48-23.03 461.96-20.65 461.96-14.5L461.96-14.5Q461.96-10.9 458.41-10.9L458.41-10.9 447.56-10.9Q447.76-7.75 449.18-6.45 450.61-5.15 453.71-5.15L453.71-5.15Q455.41-5.15 456.96-5.55 458.51-5.95 459.21-6.35L459.21-6.35 459.91-6.75 461.41-2.75Q461.11-2.4 460.53-1.88 459.96-1.35 457.63-0.48 455.31 0.4 452.36 0.4ZM447.61-15.05L455.51-15.35Q455.61-16.05 455.61-17.05 455.61-18.05 454.81-19.18 454.01-20.3 452.03-20.3 450.06-20.3 449.01-19.1 447.96-17.9 447.61-15.05L447.61-15.05ZM464.51-21.15L465.01-25Q467.76-25.6 469.96-25.6 472.16-25.6 473.61-25.5L473.61-25.5 473.61-23Q474.86-24.05 476.93-24.73 479.01-25.4 480.91-25.4L480.91-25.4Q485.81-25.4 487.78-23.1 489.76-20.8 489.76-15.15L489.76-15.15 489.76-5.55Q491.71-4.8 492.51-3.85L492.51-3.85 492.01 0 480.51 0 480.01-3.85Q480.71-4.8 482.76-5.55L482.76-5.55 482.76-15.45Q482.76-18.15 481.88-19.07 481.01-20 478.76-20 476.51-20 474.26-18.4L474.26-18.4 474.26-5.55Q476.21-4.8 477.01-3.85L477.01-3.85 476.51 0 465.01 0 464.51-3.85Q465.21-4.8 467.26-5.55L467.26-5.55 467.26-19.45Q465.51-20.05 464.51-21.15L464.51-21.15ZM499.7-31.3L503.35-31.3 503.35-25 510.5-25 510.5-20.8 503.35-20.8 503.35-8.15Q503.35-6.55 503.8-5.83 504.25-5.1 505.95-5.1 507.65-5.1 509.6-5.85L509.6-5.85 511.1-1.95Q507.25 0 503.23 0 499.2 0 497.78-1.73 496.35-3.45 496.35-6.75L496.35-6.75 496.35-20.8 494.1-20.8 493.55-23.85Q494.35-24.8 496.85-25.75L496.85-25.75Q497.45-29.85 499.7-31.3L499.7-31.3Z" opacity="1" transform="matrix(1,0,0,1,0,0)" fill="#0063db" class="undefined-text-1" data-fill-palette-color="secondary" id="text-1"></path></svg></g></svg></g></svg></g></svg></g><g transform="matrix(1,0,0,1,407.64678115178805,0)"><svg viewBox="0 0 117.06708833306826 117.06708833306826" height="117.06708833306826" width="117.06708833306826"><g data-palette-color="#000000"><rect width="31.998337477705324" height="117.06708833306826" fill="#fff" stroke="transparent" data-fill-palette-color="accent" x="0" fill-opacity="1"></rect><rect width="31.998337477705324" height="117.06708833306826" fill="#fff" stroke="transparent" data-fill-palette-color="accent" x="39.022362777689416" fill-opacity="0.75"></rect><rect width="31.998337477705324" height="117.06708833306826" fill="#fff" stroke="transparent" data-fill-palette-color="accent" x="78.04472555537883" fill-opacity="0.5"></rect></g></svg></g></svg></g><defs></defs></svg><rect width="395.52" height="88.243092988857" fill="none" stroke="none" visibility="hidden"></rect></g></svg></g></svg>
                    </div>
                    <!-- close button for mobile -->
                    <button class="flex justify-center items-center md:hidden w-12 h-12 border-2 rounded-lg mx-3" id="close-btn" type="button">
                        <span class="material-icons-outlined text-4xl text-center">close</span>
                    </button>
                </div>
                <!-- Name and Logout container  -->
                <div class="block lg:hidden mt-10">
                    <div class="ml-0 lg:ml-3 xl:ml-0 flex gap-5 xl:gap-10 items-center flex-col">
                        <h3 class="py-3 text-center text-2xl font-semibold tracking-wide">Welcome <?= $_SESSION['name']?></h3>
                        <a href="logout" class="group flex items-center border-2 rounded-lg relative px-5 py-0.5 min-w-140 lg:h-fit xl:h-14 border-slate-100 mx-5 transition-all duration-200 ease-in overflow-hidden before:-left-3 before:absolute before:w-3 before:h-full before:transition-all before:duration-200 before:ease-in hover:bg-slate-100 hover:bg-opacity-10 hover:before:w-3 hover:before:h-full hover:before:absolute hover:before:bg-slate-100 hover:before:left-0 active:bg-slate-100 active:bg-opacity-25 active:border-slate-400 active:before:bg-slate-400 active:before:transition-none active:transition-none"><span class="material-symbols-outlined text-4xl transition-all duration-200 ease-in group-hover:translate-x-1.5">logout</span><span class="text-xl font-semibold transition-all duration-200 ease-in group-hover:translate-x-1.5"> Logout</span></a>
                    </div>
                </div>
                <!-- buttons container on the sidebar -->
                <div class="flex flex-col relative top-10 gap-y-6">
                    <a href="addSingleTask" class="group flex items-center gap-4 relative h-16 border-2 rounded-lg border-slate-100 mx-5 transition-all duration-200 ease-in overflow-hidden before:-left-3 before:absolute before:w-3 before:h-full before:transition-all before:duration-200 before:ease-in hover:bg-slate-100 hover:bg-opacity-10 hover:before:w-3 hover:before:h-full hover:before:absolute hover:before:bg-slate-100 hover:before:left-0 active:bg-slate-100 active:bg-opacity-25 active:border-slate-400 active:before:bg-slate-400 active:before:transition-none active:transition-none focus:outline focus:outline-2 focus:outline-offset-1 focus:outline-blue-400">
                        <span class="ml-1 material-icons-outlined text-4xl transition-all duration-200 ease-in group-hover:translate-x-3">add_box</span>
                        <h2 class="text-xl font-semibold w-4/6 text-left transition-all duration-200 ease-in group-hover:translate-x-3">Add a Single Task</h2>
                    </a>
                    <a href="addMultiTasks" class="group flex items-center gap-5 relative h-16 border-2 rounded-lg border-slate-100 mx-5 transition-all duration-200 ease-in overflow-hidden before:-left-3 before:absolute before:w-3 before:h-full before:transition-all before:duration-200 before:ease-in hover:bg-slate-100 hover:bg-opacity-10 hover:before:w-3 hover:before:h-full hover:before:absolute hover:before:bg-slate-100 hover:before:left-0 active:bg-slate-100 active:bg-opacity-25 active:border-slate-400 active:before:bg-slate-400 active:before:transition-none active:transition-none focus:outline focus:outline-2 focus:outline-offset-1 focus:outline-blue-400">
                        <span class="ml-1 material-icons-outlined text-4xl transition-all duration-200 ease-in group-hover:translate-x-3">library_add</span>
                        <h2 class="text-xl font-semibold w-4/6 text-left transition-all duration-200 ease-in group-hover:translate-x-3">Add Multiple Tasks</h2>
                    </a>
                    <button class="delete-btn group flex items-center gap-5 relative h-16 text-red-500 border-2 rounded-lg border-red-600 mx-5 transition-all duration-200 ease-in overflow-hidden before:-left-3 before:absolute before:w-3 before:h-full before:transition-all before:duration-200 before:ease-in hover:text-slate-100 hover:bg-red-600 hover:border-slate-100 hover:before:w-3 hover:before:h-full hover:before:absolute hover:before:bg-slate-100 hover:before:left-0 active:bg-red-800 active:border-slate-400 active:before:bg-slate-400 active:before:transition-none active:transition-none focus:outline focus:outline-2 focus:outline-offset-1 focus:outline-red-400" type="button" id="delete-all">
                        <span class="ml-1 material-icons-outlined text-4xl transition-all duration-200 ease-in group-hover:translate-x-3">delete_forever</span>
                        <h2 class="text-xl font-semibold w-4/6 text-left transition-all duration-200 ease-in group-hover:translate-x-3">DELETE ALL TASKS</h2>
                    </button>
                </div>
            </div>
        </aside>
        <div class="delete-popup hidden top-1/2 left-1/2 w-[500px] max-w-[94%] h-72 bg-slate-100 text-slate-900 rounded-xl px-3 py-8 -translate-x-1/2 -translate-y-1/2 z-50 transition-all duration-1000" id="delete-all-popup">
            <div class="flex flex-col justify-between items-center w-full h-full">
                <p class="text-center font-semibold text-2xl">ARE YOU SURE THAT YOU WANT TO DELETE <span class="font-bold text-red-600">ALL YOUR TASKS</span> PERMANENTLY?</p>
                <div class="flex gap-8">
                    <button class="cancel-btn w-24 bg-slate-900 text-slate-100 px-4 py-2 rounded-lg">Cancel</button>
                    <a href="../tasks/deleteAll/<?=$_SESSION['ID']?>" class="rounded-lg"><p class="w-24 bg-red-600 text-slate-100 px-4 py-2 rounded-lg">DELETE</p></a>
                </div>
            </div>
        </div>
        <main class="relative">
            <header class="sticky top-0 z-20">
                <nav class="w-full h-20 flex justify-around items-center border-b border-slate-100 bg-opacity-50 backdrop-blur">
                    <div>
                        <div class="flex">
                            <button class="w-12 h-10 py-2 border border-slate-100 bg-slate-900 rounded-l-lg" disabled><span class="material-symbols-outlined">search</span></button>
                            <input class="sm:w-96 h-10 px-3 py-2 text-slate-900 rounded-r-lg" id="search" type="search" name="search" placeholder="Search for task(s)" required>
                        </div>
                    </div>
                    <button class="flex justify-center items-center md:hidden w-12 h-14 border-2 rounded-md bg-slate-900" id="open-btn" type="button"><span class="material-symbols-outlined text-4xl">menu</span></button>
                    <div class="hidden lg:block">
                        <div class="ml-0 lg:ml-3 xl:ml-0 flex gap-5 xl:gap-10 items-center">
                            <h3 class="py-3 text-lg text-center xl:text-2xl xl:font-semibold tracking-wide">Welcome <?= $_SESSION['name']?></h3>
                            <a href="logout" class="group flex items-center border-2 rounded-lg relative px-5 py-0.5 min-w-140 lg:h-fit xl:h-14 border-slate-100 mx-5 transition-all duration-200 ease-in overflow-hidden before:-left-3 before:absolute before:w-3 before:h-full before:transition-all before:duration-200 before:ease-in hover:bg-slate-100 hover:bg-opacity-10 hover:before:w-3 hover:before:h-full hover:before:absolute hover:before:bg-slate-100 hover:before:left-0 active:bg-slate-100 active:bg-opacity-25 active:border-slate-400 active:before:bg-slate-400 active:before:transition-none active:transition-none"><span class="material-symbols-outlined text-4xl transition-all duration-200 ease-in group-hover:translate-x-1.5">logout</span><span class="text-xl font-semibold transition-all duration-200 ease-in group-hover:translate-x-1.5"> Logout</span></a>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="px-4" id="contents">
                <section>
                    <h1 class="text-6xl font-black text-transparent bg-slate-100 bg-clip-text text-stroke-1 text-shadow-h1 font-sans mb-10 relative before:w-24 before:h-1 before:absolute before:bg-slate-100 before:-bottom-2">Your Board</h1>
                </section>
                <section class="w-full flex justify-between gap-x-4 gap-y-6 flex-wrap xl:flex-nowrap">
                    <!-- To do -->
                    <div class="w-full h-fit mx-auto sm:w-3/4 lg:w-2/3 bg-slate-700 px-3 py-4 rounded-lg">
                        <div class="flex justify-around items-start flex-wrap gap-4 mb-8">
                            <div class="flex w-28 items-center justify-between">
                                <h4 class="inline-block text-2xl font-semibold relative before:w-16 before:h-0.5 before:absolute before:bg-slate-100 before:-bottom-1">To Do</h4>
                                <span class="self-start w-7 h-7 bg-blue-700 rounded-full p-1 text-center">
                                    <?php
                                    foreach($getTasks as $task) {
                                        if($task['State'] == 'do') {
                                            $do++;
                                        }
                                    }
                                    echo $do;
                                    ?>
                                </span>
                            </div>
                            <div class="inline-block">
                                <span class="mr-2">Sort by:</span>
                                <button class="name-sorting bg-slate-100 text-slate-900 px-2 py-0.5 rounded-lg" type="button">Name</button>
                                <button class="date-sorting bg-slate-100 text-slate-900 px-2 py-0.5 ml-2 rounded-lg" type="button">Date</button>
                            </div>
                        </div>
                        <div class="tasks-container">
                            <?php
                                foreach($getTasks as $task) {
                                    if($task['State'] == 'do') {
                                        $do++;
                            ?>
                            <!-- ===================== Task Container ===================== -->
                            <div class="border-2 border-slate-100 rounded-lg px-3 pt-3 mt-4 overflow-hidden">
                                <!-- Title of the task -->
                                <div class="w-full border-b">
                                    <h5 class="text-xl font-semibold tracking-wider"><?=$task['Title']?></h5>
                                </div>
                                <!-- Description of the task -->
                                <div class="my-3 p-1.5">
                                    <p><?=$task['Description']?></p>
                                </div>
                                <!-- Footer of the task -->
                                <div class="relative py-1 flex justify-between items-center text-slate-900 before:absolute before:top-0 before:-left-16 before:h-96 before:w-screen before:bg-slate-100">
                                    <div class="relative z-10">
                                        <p class="date tracking-wide font-semibold"><?=$task['Deadline']?></p>
                                    </div>
                                    <div class="relative flex items-start gap-x-4 z-10">
                                        <button type="button" class="delete-btn <?=$task['TaskID']?>">
                                            <span class="material-symbols-outlined text-3xl text-red-600">delete</span>
                                        </button>
                                        <a href="../tasks/update/<?=$task['TaskID']?>">
                                            <span class="material-symbols-outlined text-3xl text-blue-600">edit_square</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="delete-popup hidden top-1/2 left-1/2 w-[500px] max-w-[94%] h-72 bg-slate-100 text-slate-900 rounded-xl px-3 py-8 -translate-x-1/2 -translate-y-1/2 z-50 transition-all duration-1000">
                                    <div class="flex flex-col justify-between items-center w-full h-full">
                                        <p class="text-center font-semibold text-2xl">ARE YOU SURE THAT YOU WANT TO DELETE YOUR TASK PERMANENTLY?</p>
                                        <div class="flex gap-8">
                                            <button class="cancel-btn w-24 bg-slate-900 text-slate-100 px-4 py-2 rounded-lg">Cancel</button>
                                            <a href="../tasks/delete/<?=$task['TaskID']?>" class="rounded-lg"><p class="w-24 bg-red-600 text-slate-100 px-4 py-2 rounded-lg">DELETE</p></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <!-- Doing -->
                    <div class="w-full h-fit mx-auto sm:w-3/4 lg:w-2/3 bg-slate-700 px-3 py-4 rounded-lg">
                        <div class="flex justify-around items-start flex-wrap gap-4 mb-8">
                            <div class="flex w-28 items-center justify-between">
                                <h4 class="inline-block text-2xl font-semibold relative before:w-16 before:h-0.5 before:absolute before:bg-slate-100 before:-bottom-1">Doing</h4>
                                <span class="self-start w-7 h-7 bg-blue-700 rounded-full p-1 text-center">
                                    <?php
                                    foreach($getTasks as $task) {
                                        if($task['State'] == 'doing') {
                                            $doing++;
                                        }
                                    }
                                    echo $doing;
                                    ?>
                                </span>
                            </div>
                            <div class="inline-block">
                                <span class="mr-2">Sort by:</span>
                                <button class="name-sorting bg-slate-100 text-slate-900 px-2 py-0.5 rounded-lg" type="button">Name</button>
                                <button class="date-sorting bg-slate-100 text-slate-900 px-2 py-0.5 ml-2 rounded-lg" type="button">Date</button>
                            </div>
                        </div>
                        <div class="tasks-container">
                            <?php
                                foreach($getTasks as $task) {
                                    if($task['State'] == 'doing') {
                            ?>
                            <!-- ===================== Task Container ===================== -->
                            <div class="border-2 border-slate-100 rounded-lg px-3 pt-3 mt-4 overflow-hidden">
                                <!-- Title of the task -->
                                <div class="w-full border-b">
                                    <h5 class="text-xl font-semibold tracking-wider"><?=$task['Title']?></h5>
                                </div>
                                <!-- Description of the task -->
                                <div class="my-3 p-1.5">
                                    <p><?=$task['Description']?></p>
                                </div>
                                <!-- Footer of the task -->
                                <div class="relative py-1 flex justify-between items-center text-slate-900 before:absolute before:top-0 before:-left-16 before:h-96 before:w-screen before:bg-slate-100">
                                    <div class="relative z-10">
                                        <p class="date tracking-wide font-semibold"><?=$task['Deadline']?></p>
                                    </div>
                                    <div class="relative flex items-start gap-x-4 z-10">
                                        <button type="button" class="delete-btn <?=$task['TaskID']?>">
                                            <span class="material-symbols-outlined text-3xl text-red-600">delete</span>
                                        </button>
                                        <a href="../tasks/update/<?=$task['TaskID']?>">
                                            <span class="material-symbols-outlined text-3xl text-blue-600">edit_square</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="delete-popup hidden top-1/2 left-1/2 w-[500px] max-w-[94%] h-72 bg-slate-100 text-slate-900 rounded-xl px-3 py-8 -translate-x-1/2 -translate-y-1/2 z-50">
                                    <div class="flex flex-col justify-between items-center w-full h-full">
                                        <p class="text-center font-semibold text-2xl">ARE YOU SURE THAT YOU WANT TO DELETE YOUR TASK PERMANENTLY?</p>
                                        <div class="flex gap-8">
                                            <button class="cancel-btn w-24 bg-slate-900 text-slate-100 px-4 py-2 rounded-lg">Cancel</button>
                                            <a href="../tasks/delete/<?=$task['TaskID']?>" class="rounded-lg"><p class="w-24 bg-red-600 text-slate-100 px-4 py-2 rounded-lg">DELETE</p></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <!-- Done -->
                    <div class="w-full h-fit mx-auto sm:w-3/4 lg:w-2/3 bg-slate-700 px-3 py-4 rounded-lg">
                        <div class="flex justify-around items-start flex-wrap gap-4 mb-8">
                            <div class="flex w-28 items-center justify-between">
                                <h4 class="inline-block text-2xl font-semibold relative before:w-16 before:h-0.5 before:absolute before:bg-slate-100 before:-bottom-1">Done</h4>
                                <span class="self-start w-7 h-7 bg-blue-700 rounded-full p-1 text-center">
                                    <?php
                                    foreach($getTasks as $task) {
                                        if($task['State'] == 'done') {
                                            $done++;
                                        }
                                    }
                                    echo $done;
                                    ?>
                                </span>
                            </div>
                            <div class="inline-block">
                                <span class="mr-2">Sort by:</span>
                                <button class="name-sorting bg-slate-100 text-slate-900 px-2 py-0.5 rounded-lg" type="button">Name</button>
                                <button class="date-sorting bg-slate-100 text-slate-900 px-2 py-0.5 ml-2 rounded-lg" type="button">Date</button>
                            </div>
                        </div>
                        <div class="tasks-container">
                            <?php
                                foreach($getTasks as $task) {
                                    if($task['State'] == 'done') {
                            ?>
                            <!-- ===================== Task Container ===================== -->
                            <div class="border-2 border-slate-100 rounded-lg px-3 pt-3 mt-4 overflow-hidden">
                                <!-- Title of the task -->
                                <div class="w-full border-b">
                                    <h5 class="text-xl font-semibold tracking-wider"><?=$task['Title']?></h5>
                                </div>
                                <!-- Description of the task -->
                                <div class="my-3 p-1.5">
                                    <p><?=$task['Description']?></p>
                                </div>
                                <!-- Footer of the task -->
                                <div class="relative py-1 flex justify-between items-center text-slate-900 before:absolute before:top-0 before:-left-16 before:h-96 before:w-screen before:bg-slate-100">
                                    <div class="relative z-10">
                                        <p class="date tracking-wide font-semibold"><?=$task['Deadline']?></p>
                                    </div>
                                    <div class="relative flex items-start gap-x-4 z-10">
                                        <button type="button" class="delete-btn <?=$task['TaskID']?>">
                                            <span class="material-symbols-outlined text-3xl text-red-600">delete</span>
                                        </button>
                                        <a href="../tasks/update/<?=$task['TaskID']?>">
                                            <span class="material-symbols-outlined text-3xl text-blue-600">edit_square</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="delete-popup hidden top-1/2 left-1/2 w-[500px] max-w-[94%] h-72 bg-slate-100 text-slate-900 rounded-xl px-3 py-8 -translate-x-1/2 -translate-y-1/2 z-50">
                                    <div class="flex flex-col justify-between items-center w-full h-full">
                                        <p class="text-center font-semibold text-2xl">ARE YOU SURE THAT YOU WANT TO DELETE YOUR TASK PERMANENTLY?</p>
                                        <div class="flex gap-8">
                                            <button class="cancel-btn w-24 bg-slate-900 text-slate-100 px-4 py-2 rounded-lg">Cancel</button>
                                            <a href="../tasks/delete/<?=$task['TaskID']?>" class="rounded-lg"><p class="w-24 bg-red-600 text-slate-100 px-4 py-2 rounded-lg">DELETE</p></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
    <div class="delete-bg-blur hidden top-1/2 left-1/2 w-screen h-screen rounded-xl -translate-x-1/2 -translate-y-1/2 z-40 backdrop-blur"></div>
</body>
</html>

<?php }