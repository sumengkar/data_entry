<?php
class Media extends Backend_controller {
    protected $offset = 0;
    protected $limit  = 25;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('directory');
        $this->load->helper('file');
        $this->load->helper('number');
        $this->load->helper('date');
    }

    public function index()
    {
        if ($this->user_m->hasPermission('access', 'Media')) {
            $this->data['subview'] = 'backend/media/index';
        } else {
            $this->session->set_flashdata('error', lang('error_permission'));
            $this->data['subview'] = 'backend/common/error';
        }

    	$this->load->view('backend/_layout_main', $this->data);
    }

    public function fetch_data()
    {
        // Only ajax
        check_is_ajax();

        $files_info  = array();
        $files_data  = array();
        $images_data = array();

        $files_data  = glob_recursive('uploads/files/' . '*', GLOB_BRACE);
        $images_data = glob_recursive('uploads/images/' . '*', GLOB_BRACE);

        foreach(array_merge($files_data, $images_data) as $file) {
            if (is_file($file)) {
                $result = get_file_info($file);

                if ($result) {
                    $fetch_data[] = array(
                        '0' => $result['server_path'],
                        '2' => $result['name'],
                        '3' => byte_format($result['size']),
                        '4' => $result['date'],
                        '5' => get_mime_by_extension($result['server_path'])
                    );
                }
            }
        }

        // Datatable
        if ($fetch_data) {
            $data = array();
            foreach ($fetch_data as $key => $row) {
                $sub_array = array();
                $sub_array[] = datatable_checkbox($row['0']);
                $sub_array[] = datatable_image(image_thumb($row['0'], 'medium'), 'tbl-image-square');
                $sub_array[] = $row['2'];
                $sub_array[] = $row['3'];
                $sub_array[] = timespan($row['4'], time(), 1) . ' ago';

                $data[] = $sub_array;
            }

            $offset = $_POST["start"];
            $limit  = $_POST["length"];

            // Search datatable
            if (isset($_POST["search"]["value"])) {
                $data = search_array($_POST["search"]["value"], $data, $key=2);
            }

            // Sort datatable
            if (isset($_POST["order"])) {
                $data = sort_array($data, $_POST['order']['0']['column'], $_POST['order']['0']['dir']);
            }

            $output_data = array_splice($data, $offset, $limit);

            $output = array(
                'draw'            => intval($_POST["draw"]),
                'recordsTotal'    => count($fetch_data),
                'recordsFiltered' => count($fetch_data),
                'data'            => $output_data
            );

            $this->output->set_output(json_encode($output));
        }
    }

    public function file_manager($target = NULL, $thumb = NULL)
    {
        // Return the target ID for the file manager to set the value
        if ($target) {
            $this->data['target'] = $target;
        } else {
            $this->data['target'] = '';
        }

        // Return the thumbnail for the file manager to show a thumbnail
        if ($thumb) {
            $this->data['thumb'] = $thumb;
        } else {
            $this->data['thumb'] = '';
        }

        $this->load->view('backend/common/file_manager', $this->data);
    }

    public function ajax_load($size='small')
    {
        // Only ajax
        check_is_ajax();

        // Set default array
        $files_data  = array();
        $images_data = array();
        $files_info  = array();

        // Set upload directory
        $files_dir   = 'uploads/files/';
        $images_dir  = 'uploads/images/';

        // Get file by file type
        if ($this->input->post('file_type') === 'all') {
            $files_data  = glob_recursive($files_dir . '*', GLOB_BRACE);
            $images_data = glob_recursive($images_dir . '*', GLOB_BRACE);
        }

        if ($this->input->post('file_type') === 'file') {
            $files_data  = glob_recursive($files_dir . '*', GLOB_BRACE);
        }

        if ($this->input->post('file_type') === 'image') {
            $images_data = glob_recursive($images_dir . '*', GLOB_BRACE);
        }

        // Set results file info
        foreach(array_merge($files_data, $images_data) as $file) {
            if (is_file($file)) {
                $result = get_file_info($file);

                if ($result) {
                    $files_info[] = array(
                        'name'        => $result['name'],
                        'server_path' => $result['server_path'],
                        'size'        => byte_format($result['size']),
                        'date'        => timespan($result['date'], time(), 1) . ' ago',
                        'mime'        => get_mime_by_extension($result['server_path'])
                    );
                }
            }
        }

        // Add thumb to results
        if($files_info) {
            $img_mimes = array('image/gif', 'image/jpeg', 'image/png');
            foreach($files_info as $key => $file_info) {
                if (in_array($file_info['mime'], $img_mimes)) {
                    $files_info[$key]['thumb']    = image_thumb($file_info['server_path'], $size);
                    $files_info[$key]['is_image'] = 1;
                } else {
                    $files_info[$key]['thumb']    = image_thumb('uploads/images/default/default-thumbnail-file.png', $size);
                    $files_info[$key]['is_image'] = 0;
                }
            }
        }

        // Set default array
        $json['totals']     = count($files_info);
        $json['clear_list'] = 'true';
        $json['results']    = array();

        // Filter results by search
        if ($this->input->post('search') !== NULL && $this->input->post('search') !== '') {
            $search_data        = search_array($this->input->post('search'), $files_info, $key='name');
            $search_to_loadmore = $search_data;
            $json['totals']     = count($search_data);
            $json['results']    = array_splice($search_data, $this->offset, $this->limit);
            $json['offset']     = count($json['results']) + $this->input->post('offset');
        }

        // Loadmore results
        if ($this->input->post('offset') !== NULL && $this->input->post('offset') !== '') {
            $this->offset = $this->input->post('offset');

            if ($this->input->post('search') !== NULL && $this->input->post('search') !== '') {
                $data_loadmore = $search_to_loadmore;
            } else {
                $data_loadmore = $files_info;
            }

            $json['totals']     = count($data_loadmore);
            $json['clear_list'] = 'false';
            $json['results']    = array_splice($data_loadmore, $this->offset, $this->limit);
            $json['offset']     = count($json['results']) + $this->input->post('offset');
        }

        // Default results to show
        if (! $this->input->post('search') && ! $this->input->post('offset')) {
            $json['results']    = array_splice($files_info, $this->offset, $this->limit);
            $json['offset']     = count($json['results']) + $this->input->post('offset');
        }

        // Send results to view with json
        $this->output->set_output(json_encode($json));
    }

    public function add($id = NULL)
    {
        // Load view
        if ($this->user_m->hasPermission('access', 'Media')) {
            $this->data['subview'] = 'backend/media/add_media';
        } else {
            $this->session->set_flashdata('error', lang('error_permission'));
            $this->data['subview'] = 'backend/common/error';
        }
        $this->load->view('backend/_layout_main', $this->data);
    }

    public function upload($size = 'small', $dir = NULL)
    {
        if ( ! empty($_FILES))
        {
            $image_mime = array('image/png', 'image/jpeg', 'image/gif');

            if (! in_array($_FILES['file']['type'], $image_mime)) {
                $config['upload_path']   = "./uploads/files/";
            } else {
                $config['upload_path']   = "./uploads/images/";
            }

            $config['allowed_types'] = 'jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF|pdf|PDF|docx|doc|DOC|xlsx|xls|XLXS|XLS|zip|rar|gz|tar.gz';
            $config['max_size']      = '2000';

            $this->load->library('upload', $config);
            if ($this->user_m->hasPermission('modify', 'Media')) {
                if (! $this->upload->do_upload("file")) {
                    $json['error'] = $this->upload->display_errors();
                } else {
                    $upload_data = $this->upload->data();
                    $json['is_image'] = $upload_data['is_image'] ? 1 : 0;

                    if ($upload_data['is_image']) {
                        $json['url']  = image_thumb('uploads/images/' . $upload_data['file_name'], $size);
                        $json['path'] = 'uploads/images/' . $upload_data['file_name'];
                        $json['name'] = $upload_data['file_name'];
                    } else {
                        $json['url']  = image_thumb('uploads/images/default/default-thumbnail-file.png');
                        $json['path'] = 'uploads/files/' . $upload_data['file_name'];
                        $json['name'] = $upload_data['file_name'];
                    }
                }
            } else {
                $json['error'] = lang('error_permission');
            }
            $this->output->set_output(json_encode($json));
        }
    }

    public function delete()
    {
        if ($this->validate_delete('Media')) {
            $media = $this->setting_m->get_setting('media_setting');

            if ($this->input->post('file_to_remove'))
            {
                $file_to_remove = $this->input->post('file_to_remove');
                $file_small     = dirname( $file_to_remove ) . '/cache/' . $media['image_sm_width'] . 'x' . $media['image_sm_height'] . '_' . basename($file_to_remove);
                $file_medium    = dirname( $file_to_remove ) . '/cache/' . $media['image_md_width'] . 'x' . $media['image_md_height'] . '_' . basename($file_to_remove);
                $file_larger    = dirname( $file_to_remove ) . '/cache/' . $media['image_lg_width'] . 'x' . $media['image_lg_height'] . '_' . basename($file_to_remove);

                if (file_exists($file_small)) {
                    unlink($file_small);
                }

                if (file_exists($file_medium)) {
                    unlink($file_medium);
                }

                if (file_exists($file_larger)) {
                    unlink($file_larger);
                }

                if (file_exists($file_to_remove)) {
                    unlink($file_to_remove);
                }
            }

            if ($this->input->post('selected')) {
                foreach ($this->input->post('selected') as $file) {
                    $file_to_remove = $file;
                    $file_small     = dirname( $file_to_remove ) . '/cache/' . $media['image_sm_width'] . 'x' . $media['image_sm_height'] . '_' . basename($file_to_remove);
                    $file_medium    = dirname( $file_to_remove ) . '/cache/' . $media['image_md_width'] . 'x' . $media['image_md_height'] . '_' . basename($file_to_remove);
                    $file_larger    = dirname( $file_to_remove ) . '/cache/' . $media['image_lg_width'] . 'x' . $media['image_lg_height'] . '_' . basename($file_to_remove);

                    if (file_exists($file_small)) {
                        unlink($file_small);
                    }

                    if (file_exists($file_medium)) {
                        unlink($file_medium);
                    }

                    if (file_exists($file_larger)) {
                        unlink($file_larger);
                    }

                    if (file_exists($file_to_remove)) {
                        unlink($file_to_remove);
                    }
                }

                $this->session->set_flashdata('success', lang('success_single_delete'));
                redirect('media');
            }

            if (! $this->input->post('file_to_remove') && ! $this->input->post('selected')) {
                $this->session->set_flashdata('error', lang('error_delete'));
                redirect('media');
            }
        }
    }
}