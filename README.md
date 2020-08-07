// Game progress

Confirm that defenders are now saved correctly, as 'buildings', so they're included in the rebuild.

The buildings are not behaving correctly with the saved ones. The saved ones need to be added to a store, and the 
new buildings need to base themselves on it.

TODO:
- Finish writing the alien attack event. It needs to measure current progress against a new line each time,
each wave is larger. It needs its own modal (I think?) because it should superimpose the action.

- Add the random events which help/hinder game progress. 

- Pixel art instead of buildings - this will mean exchanging buildings on the canvas for images,
but keeping the size and coordinates the same.

- Add movement to the defenders, so they move around the canvas without intersecting with buildings.

- make the game canvas larger, especially at larger screen sizes.

