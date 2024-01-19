<div id='select'>
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
            <button onclick="booking()">確定</button>
            <button>重置</button>
        </div>
    </div>
</div>


<div id="booking" style='display:none'>

</div>








<script>
    let url = new URL(window.location.href)

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
            if (url.searchParams.has('id')) {
                $(`#movie option[value='${url.searchParams.get('id')}']`).prop('selected', true);
            }
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

    function booking() {
        let order = {
            movie_id: $("#movie").val(),
            date: $("#date").val(),
            session: $("#session").val()
        }
        $.get("./api/booking.php", order, (booking) => {
            $("#booking").html(booking)
            $('#select').hide();
            $('#booking').show()
        })
    }
</script>