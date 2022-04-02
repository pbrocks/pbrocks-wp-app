/**
 * App functionality
 */

import { SearchControl, Spinner } from '@wordpress/components';

import { useState, render } from '@wordpress/element';

import { useSelect } from '@wordpress/data';

import { store as coreDataStore } from '@wordpress/core-data';

function PBrocksFirstApp() {
	const [searchTerm, setSearchTerm] = useState('');
	const { posts, hasResolved } = useSelect(
		(select) => {
			const query = {};
			if (searchTerm) {
				query.search = searchTerm;
			}
			const selectorArgs = ['postType', 'post', query];
			return {
				posts: select(coreDataStore).getEntityRecords(...selectorArgs),
				hasResolved: select(coreDataStore).hasFinishedResolution(
					'getEntityRecords',
					selectorArgs
				),
			};
		},
		[searchTerm]
	);

	return (
		<div>
			<SearchControl onChange={setSearchTerm} value={searchTerm} />
			<PostsList hasResolved={hasResolved} posts={posts} />
		</div>
	);
}

function PostsList({ hasResolved, posts }) {
	if (!hasResolved) {
		return <Spinner />;
	}
	if (!posts?.length) {
		return <div>No results</div>;
	}

	return (
		<table className="wp-list-table widefat fixed striped table-view-list">
			<thead>
				<tr>
					<td>Title</td>
				</tr>
			</thead>
			<tbody>
				{posts?.map((post) => (
					<tr key={post.id}>
						<td>{post.title.rendered}</td>
					</tr>
				))}
			</tbody>
		</table>
	);
}

window.addEventListener(
	'load',
	function () {
		render(
			<PBrocksFirstApp />,
			document.querySelector('#pbrocks-first-wp-app')
		);
	},
	false
);
