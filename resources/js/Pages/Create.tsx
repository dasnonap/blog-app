import { Link, Head } from '@inertiajs/react';
import PlateEditor from '@/Components/plate-editor';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Sidebar from '@/Components/sidebar';

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

					<div className="border">
						<PlateEditor />
					</div>
				</div>
			</div>
		</AuthenticatedLayout>
	);
};

export default Create;
