import { actionType} from "./loading";

const updateLoading = (loading) => ({
    type: actionType.updateLoading,
    loading: loading
})

export default {
    updateLoading
}