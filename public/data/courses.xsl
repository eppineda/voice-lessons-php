<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>
        <title>Sing Like a Pro!</title>
	<link href="https://cdn.jsdelivr.net/npm/picnic" rel="stylesheet"></link>
	<script src="https://unpkg.com/htmx.org@2.0.0/dist/htmx.esm.js" type="module"></script>
</head>
<body>
	<h1>Course Catalog</h1>
	<p>These are all of the classes availble from this singing school.</p>
  	<table border="1">
	<tr bgcolor="#9acd32">
	  	<th style="text-align:left">Course Number</th>
	  	<th style="text-align:left">Course Title</th>
	  	<th style="text-align:left">Course Description</th>
	</tr>
	<xsl:for-each select="catalog/course">
	<tr>
		<td><xsl:value-of select="id" /></td>
		<td><xsl:value-of select="title" /></td>
		<td><xsl:value-of select="description" /></td>
	</tr>
	</xsl:for-each>
  </table>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
