<style type="text/css">
<<<<<<< HEAD
	#data-table-{$ID}					{ width:<% if $Width %>$Width<% else %>100%<% end_if %>; }
=======
>>>>>>> f028dd8... ## [0.0.1]
<% if $BorderColor %>
	#data-table-{$ID} table,
	#data-table-{$ID} th,
	#data-table-{$ID} td				{ border-color:$BorderColor; border-width:1px; border-style:solid; border-collapse:collapse; }
<% end_if %>
<<<<<<< HEAD
=======

	#data-table-{$ID}					{ width:<% if $Width %>$Width<% else %>100%<% end_if %>; }

>>>>>>> f028dd8... ## [0.0.1]
<% if $CellPadding %>
	#data-table-{$ID} th,
	#data-table-{$ID} td				{ padding:$CssPadding; }
<% end_if %>
<<<<<<< HEAD
=======


>>>>>>> f028dd8... ## [0.0.1]
</style>

<div class="data-table-wrap" id="data-table-{$ID}">
	<table class="data-table<% if $BorderColor %> border<% end_if %><% if $Striped %> striped<% end_if %>" cellpadding="$CellPadding" cellspacing="0" border="<% if $BorderColor %>1<% else %>0<% end_if %>">
		<% if $FirstRowHeader %>
			<thead>
				<tr>
					<% with $HeaderRow %>
						<% loop $DataTableColumns %>
<<<<<<< HEAD
							<th align="$Align.LowerCase"><% if $Content %>$Content.RAW<% else %>&nbsp;<% end_if %></th>
=======
							<th align="$Align.LowerCase">$Content.RAW</th>
>>>>>>> f028dd8... ## [0.0.1]
						<% end_loop %>
					<% end_with %>
				</tr>
			</thead>
		<% end_if %>
		<tbody>
			<% loop $BodyRows %>
				<tr class="$EvenOdd">
					<% loop $BodyColumns %>
<<<<<<< HEAD
						<td<% if $DataTableRow.DataTable.FirstRowHeader %> data-title="$ParentColumn.Content"<% end_if %> align="$Align.LowerCase"<% if not $Content %> data-empty="1"<% end_if %>>
							<% if $Content %>$Content.RAW<% else %>&nbsp;<% end_if %>
=======
						<td<% if $DataTableRow.DataTable.FirstRowHeader %> data-title="$ParentColumn.Content"<% end_if %> align="$Align.LowerCase">
							$Content.RAW
>>>>>>> f028dd8... ## [0.0.1]
						</td>
					<% end_loop %>
				</tr>
			<% end_loop %>
		</tbody>
	</table>
</div>
