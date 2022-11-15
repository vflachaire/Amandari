		countArticle = 0;
		var mySlideData = new Array();

				mySlideData[countArticle++] = new Array(
			'photos/diapo01.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo05.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo10.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo11.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo04.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo08.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo06.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo09.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo02.jpg',
			'',
			'',
			''
			);
				mySlideData[countArticle++] = new Array(
			'photos/diapo07.jpg',
			'',
			'',
			''
			);

		function addLoadEvent(func) {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {
		window.onload = func;
		} else {
		window.onload = function() {
		oldonload();
		func();
		} } }

		function startSlideshow() {
		initSlideShow($('mySlideshow'), mySlideData);
		}
		addLoadEvent(startSlideshow);

