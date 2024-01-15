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
        <label>場次</label>
        <select name="session" id="session"></select>
    </div>
    <div>
        <button>確定</button>
        <button>重置</button>
    </div>
</div>
<script>
    getMovies();

    $("#movie").on("change", function() {
        getDates($("#movie").val())
    })

    $("#date").on("change", function() {
        getSessions($("#movie").val(), $("#date").val())
    })

    function getMovies() {
        $.get("./api/get_movies.php", (movies) => {
            $("#movie").html(movies);
            getDates($("#movie").val())
        })
    }

    function getDates(id) {
        $.get("./api/get_dates.php", {
            id
        }, (dates) => {
            $("#date").html(dates);
            let movie = $("#movie").val()
            let date = $("#date").val()
            getSessions(movie, date)
        })
    }

    function getSessions(movie, date) {
        $.get("./api/get_sessions.php", {
            movie,
            date
        }, (sessions) => {
            $("#session").html(sessions);
        })
    }
</script>