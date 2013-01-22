function loadContent(url) {
	$("#content").load(url);
}

function addTab(id, node, url) {
	if (id.tabs("exists", node))	{
		id.tabs("select", node);
	} else {
		id.tabs("close", 0);
		id.tabs("add", {
			title: node,
			href: url,
			closable: true
		});
	}
}