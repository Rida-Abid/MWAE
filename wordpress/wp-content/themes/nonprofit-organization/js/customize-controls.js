( function( api ) {

	// Extends our custom "nonprofit-organization" section.
	api.sectionConstructor['nonprofit-organization'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );