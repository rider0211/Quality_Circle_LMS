
/*
Copyright 2018 Google Inc.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/
importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.5.0/workbox-sw.js');

if (workbox) {
  	console.log(`Yay! Workbox is loaded ðŸŽ‰`);

  	
  	workbox.precaching.precacheAndRoute([
	  	{
			"url": "/",
		    "revision": "f98c28b41c5cb7e2910985707c35b1e4"
		}
	]);


  	workbox.routing.registerRoute(
	  	/(.*)articles(.*)\.(?:png|gif|jpg|svg)/,
	  	workbox.strategies.cacheFirst({
	    	cacheName: 'images-cache',
	    	plugins: [
	      		new workbox.expiration.Plugin({
	        		maxEntries: 50,
	        		maxAgeSeconds: 30 * 24 * 60 * 60, // 30 Days
	      		})
	    	]
	  	})
	);

	const articleHandler = workbox.strategies.networkFirst({
	  	cacheName: 'articles-cache',
	  	plugins: [
	    	new workbox.expiration.Plugin({
	      		maxEntries: 50,
	    	})
	  	]
	});

	workbox.routing.registerRoute(/(.*)\.php/, args => {
	  	return articleHandler.handle(args).then(response => {
	    	if (!response) {
	      		return caches.match('pages/offline.html');
	    	} 
	    	else if (response.status === 404) {
	      		return caches.match('pages/404.html');
	    	}
	    	return response;
	  	});
	});
	
	const queue = new workbox.backgroundSync.Queue('myQueueName');

   /* self.addEventListener('fetch', (event) => {
      // Clone the request to ensure it's save to read when
      // adding to the Queue.
      const promiseChain = fetch(event.request.clone())
      .catch((err) => {
          return queue.addRequest(event.request);
      });
    
      event.waitUntil(promiseChain);
    });*/

	//click on notification
	self.addEventListener('notificationclick', function(e) {
	  var notification = e.notification;
	  var primaryKey = notification.data.primaryKey;
	  var action = e.action;

	  if (action === 'close') {
	    notification.close();
	  } else {
	    clients.openWindow('https://gosmartacademy.com/ams/');
	    notification.close();
	  }
	});

	//add an event listner push listen the push request in service worker
	//display a notification from push
	self.addEventListener('push', function(e) {
	  var options = {
	    body: 'Clique para ver o estado de crise da sua Unidade.',
	    icon: 'img/ams_logo.png',
	    vibrate: [100, 50, 100],
	    data: {
	      dateOfArrival: Date.now(),
	      primaryKey: '2'
	    }
	  };
	  e.waitUntil(
	    self.registration.showNotification('Nova notificaÃ§Ã£o de crise na Unidade', options)
	  );
	});

} 
else {
  	console.log(`Boo! Workbox didn't load ðŸ˜¬`);
}
