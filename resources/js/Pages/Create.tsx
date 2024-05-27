import { Link, Head } from '@inertiajs/react';
import PlateEditor from '@/Components/plate-editor';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Sidebar from '@/Components/sidebar';
import { useState } from 'react';

const Tags = ({className}) => {
	const [value, setValue] = useState('');
	const [tags, setTags] = useState([]);

	const handleInput = (e) => {
		setValue(e.target.value);
	};

	const handleSubmit = (e) => {
		e.preventDefault();

		setTags([...tags, value]);
		setValue('');
	};

	return (
		<form className={className} onSubmit={handleSubmit}>
			<div className="flex flex-wrap gap-2 items-center border rounded p-2">
				{tags.map((tag) => (
					<div className="tag rounded-lg px-2 py-1 bg-slate-100">
						{tag}
					</div>
				))}

				<input
					className="focus:outline-none grow"
					placeholder="Add tags"
					type="text"
					onChange={handleInput}
					value={value}
				/>
			</div>
		</form>
	);
};

const Create = ({ auth }) => {
	return (
		<AuthenticatedLayout
			user={auth.user}
			header={
				<h2 className="font-semibold text-xl text-gray-800 leading-tight">
					Feed
				</h2>
			}
		>
			<Head title="Create" />

			<div className="grid grid-cols-[minmax(312px,_30%)_1fr]">
				<Sidebar />

				<div className="container max-w-[1064px] relative py-12">
					<div className="prose mb-6">
						<h1>Create your content</h1>
					</div>

					<Tags className="mb-4" />

					<div className="border">
						<PlateEditor />
					</div>
				</div>
			</div>
		</AuthenticatedLayout>
	);
};

export default Create;
