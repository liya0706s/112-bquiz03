<h3 class="ct">線上訂票</h3>
<div class="order">
    <div>
        <label>電影：</label>
        <select name="movie" id="movie">

        </select>
    </div>
    <div>
        <label>日期：</label>
        <select name="date" id="date"></select>
    </div>
    <div>
        <label>場次：</label>
        <select name="session" id="session"></select>
    </div>
    <div>
        <button>確定</button>
        <button>重置</button>
    </div>
</div>
<script>
    getMovies();

    // 當電影改變的時候日期也要改變選項的函式
    // let id在全域範圍重複宣告，會有衝突;這邊是都在回乎函式裡面沒關係
    $("#movie").on("change", function() {
        getDates($("#movie").val())
    })

    $("#date").on("change", function() {
        getSessions($("#movie").val(), $("#date").val())
    })

    function getMovies() {
        $.get("./api/get_movies.php", (movies) => {
            // callback function
            // 會產生很多option
            $("#movie").html(movies);
            getDates($("#movie").val())
            // movie的id 就是movie的val()
        })
    }

    function getDates(id) {
        $.get("./api/get_dates.php", {
            id
        }, (dates) => {
            // 會產生很多option
            console.log(dates)
            $("#date").html(dates);
            let movie = $("#movie").val()
            let date = $("#date").val()
            getSessions(movie, date)
        })
    }
    // 先放入有值的option看看ajax可否work

    function getSessions(movie, date) {
        $.get("./api/get_sessions.php", {
            movie,
            date
        }, (sessions) => {
            // 會產生很多option
            $("#session").html(sessions);
        })
    }
</script>

<!-- button上一步和button確定--
把#select顯示 #booking隱藏;其中一個要選擇隱藏，可以改成都toggle -->
