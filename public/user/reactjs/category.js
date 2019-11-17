function getName(name) {
    alert(name);
}

var DaCuoi = React.createClass({
    layThongTin: function() {
        alert(this.props.children);
    },
    getInitialState() {
      return {tongHocVien: this.props.number};
    },
    addMember() {
      this.setState({tongHocVien: parseInt(this.state.tongHocVien) + 1});
    },
    render: function() {
        return(
          <div>
              <h1>da cuoi {this.props.name} - {this.props.children}</h1>
              <div>So hoc vien: {this.state.tongHocVien}</div>
              <button onClick={this.layThongTin}>ddd</button>
              <button onClick={this.addMember}>add Member</button>
              <button onClick={this.addMember}>aaa</button>
              <button onClick={() => {var a = ' ss'; getName(this.props.name + a)}}>Getname</button>
          </div>
        );
    }
});

ReactDOM.render(
    <div>
        <DaCuoi name="abc" number="10">dsadadsadad</DaCuoi>
        <DaCuoi name="sads"/>
        <h1>da cuoi </h1>
        <h1 className="vang">da cuoi</h1>
    </div>
, document.getElementsByName('root'));
